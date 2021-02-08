<?php
define('TYPE_GET_ALL', 'all');
define('TYPE_GET_FIRST', 'first');
define('TYPE_GET_COUNT', 'count');
define('TYPES_GET', [TYPE_GET_ALL, TYPE_GET_FIRST, TYPE_GET_COUNT]);

define('TYPE_INT', PDO::PARAM_INT);
define('TYPE_STR', PDO::PARAM_STR);
define('TYPE_BOOL', PDO::PARAM_BOOL);

class ORM
{
    // DB attributes 
    private PDO $dbConnect;
    private string $sql;
    private $query;
    private $table;
    protected $whereFieldsAndValues;
    private $typeWhere;
    private $orderByFieldAndDirection;

    // Data entry exist ? 
    private $existInBdd = false;

    protected array $selectFieldsAndValues;
    private array $insertFieldAndValues;

    // protected $order = '';
    // protected $limit = '';
    // private array $result = [];

    public function __construct()
    {
        $this->connect();
        $this->resetPopertiesSQL();
    }


    /**
     * BDD coonexion
     *
     * @return void
     */
    private function connect(): void
    {
        $this->dbConnect = new PDO(
            'mysql:host=' . BDD_HOST . ';dbname=' . BDD_NAME,
            BDD_USER,
            BDD_PASSWORD
        );
    }

    // hydratation of data
    protected function populate($id)
    {
        $model = $this->getById($id);
        if (!$this->existInBdd($id)) {
            return false;
        }

        foreach ($model as $field => $value) {
            if (is_numeric($field)) {
                continue;
            }

            $this->$field = $value;
        }

        return true;
    }

    /**
     * Check if the corespondant $id element exist
     *
     * @return void
     */
    public function existInBdd($id)
    {
        $this->addWhereFieldsAndValues('id', $id);
        $this->setSelectFields('id');

        $this->existInBdd = (bool) $this->get(TYPE_GET_COUNT);



        return $this->existInBdd;
    }


    public function get(string $type)
    {
        if (!in_array($type, TYPES_GET)) {
            die('Error [ORM 001] : Mauvais type pour get');
        }
        $this->execute();

        switch ($type) {
            case TYPE_GET_ALL:
                return $this->query->fetchAll(PDO::FETCH_CLASS);
                break;

            case TYPE_GET_FIRST:
                return $this->query->fetch();
                break;

            case TYPE_GET_COUNT:
                return $this->query->rowCount();
                break;
        }
    }

    private function resetPopertiesSQL()
    {
        $this->whereFieldsAndValues = [];
        $this->typeWhere = 'AND';
        $this->orderByFieldAndDirection = [];
        $this->selectFieldsAndValues = [];
    }


    private function execute()
    {

        $this->buildSelectSQL();
        $this->query = $this->dbConnect->prepare($this->sql);

        // $this->dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        foreach ($this->whereFieldsAndValues as $wFaV) {
            $this->query->bindValue(':' . $wFaV['binder'], $wFaV['value'], $wFaV['type']);
        }

        if (!$this->query->execute()) {
            die('Error [ORM 002] : ' . $this->query->errorInfo()[2]);
        }

        $this->query->execute();
        $this->resetPopertiesSQL();
    }

    public function setSelectFields($fields): void
    {
        $this->selectFieldsAndValues = func_get_args();
    }

    public function addInsertField($field, $value, $type = PDO::PARAM_STR): void
    {
        $this->insertFieldAndValues[] = [
            'field' => '`' . $field . '`',
            'value' => $value,
            'bind' => ':' . $field,
            'type' => $type,
        ];
    }

    private function buildSelectSQL()
    {
        $sql = 'SELECT ';


        if (empty($this->selectFieldsAndValues)) {
            $sql .= ' * ';
        } else {
            $sql .= implode(', ', $this->selectFieldsAndValues);
        }

        $sql .= ' FROM ' . $this->table . $this->handleWhere() . $this->handleOrder();


        $this->sql = $sql;
    }

    private function buildInsertSQL()
    {
        $sql = 'INSERT INTO `' . $this->table . '` ';

        $fields = array_column($this->insertFieldAndValues, 'field');

        // Champs
        $sql .= '(';
        $sql .= implode(', ', $fields);
        $sql .= ') ';

        // Valeurs
        $sql .= 'VALUES (';
        $sql .= implode(', ', array_column($this->insertFieldAndValues, 'bind'));
        $sql .= ') ';

        $this->sql = $sql;
    }



    private function handleWhere()
    {
        if (empty($this->whereFieldsAndValues)) {
            return '';
        }

        $nb = 0;
        $binders = [];
        $wheres = [];
        foreach ($this->whereFieldsAndValues as $id => $wFaV) {

            // Vérifier que :truc n'est pas déjà 
            $binder = $wFaV['field'];
            $nb = 2;

            while (in_array($binder, $binders)) {
                $binder = $wFaV['field'] . '_' . $nb;
                $nb++;
            }
            $binders[] = $binder;


            $wheres[] = $wFaV['field'] . ' ' . $wFaV['operator'] . ' :' . $binder;

            $this->whereFieldsAndValues[$id]['binder'] = $binder;
        }

        return ' WHERE ' . implode(' AND ', $wheres);
    }

    private function handleOrder()
    {
        if (empty($this->orderByFieldAndDirection)) {
            return '';
        }

        // print_r($this->orderByFieldAndDirection); die;
        $orders = [];
        foreach ($this->orderByFieldAndDirection as $oFaD) {
            $orders[] = $oFaD['field'] . ' ' . $oFaD['direction'];
        }

        return ' ORDER BY ' . implode(' AND ', $orders);
    }

    public function addWhereFieldsAndValues($field, $value, $operator = '=', $type = TYPE_INT)
    {
        $this->whereFieldsAndValues[] = compact('field', 'value', 'operator', 'type');
    }

    public function addOrderByFieldAndDirection($field, $direction = 'ASC')
    {
        $this->orderByFieldAndDirection[] = compact('field', 'direction');
    }


    public function insert()
    {
        $this->buildInsertSQL();
        $this->query = $this->dbConnect->prepare($this->sql);
        // $this->dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // if (!$this->query->execute()) {
        //     die('Error [ORM 003] : ' . $this->query->errorInfo()[2]);
        // }

        foreach ($this->insertFieldAndValues as $iFaV) {
            $this->query->bindValue($iFaV['bind'], $iFaV['value'], $iFaV['type']);
        }

        
        // dd($this->query); die;
        dd('la');
        $this->query->execute();
        $this->resetPopertiesSQL();

        return $this->getLastID();
        // Doit retourner le new id 
    }

    public function getLastID()
    {
        $this->addOrderByFieldAndDirection('id', 'DESC');
        $this->setSelectFields('id');
        return $this->get('first')['id'];
    }



    // Méthodes d'accès rapide aux données 

    public function getById($id)
    {
        $this->addWhereFieldsAndValues('id', $id);
        $datas = $this->get('first');
        return $datas;
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
    }

    public function setTypeWhere(string $typeWhere): void
    {
        $this->typeWhere = $typeWhere;
    }

    public function exist()
    {

        // var_dump($this->existInBdd);
        // die;
        return $this->existInBdd;
    }

    // UpdateRequest
    public function update()
    {
    }
}
