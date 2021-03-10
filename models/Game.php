<?php
class Game extends ORM
{
    public $Platform;
    public $Publisher;
    public $Family;

    public function __construct($id = null)
    {
        parent::__construct();
        $this->setTable('games');

        $this->Platform = new Platform();
        $this->Publisher = new Publisher();
        $this->Family = new Family();


        if ($id != null) {
            $this->populate($id);
        }
    }
    
    // Méhodes spécifiques à ce modèle
    public function listOfPublicGames()
    {
        $this->setSelectFields('id', 'name', 'year', 'note');
        $this->addWhereFields('public', 1);
        $this->addOrder('name');
        // $this->addOrder('', 'RAND()'); // ORDER BY RAND()

        return $this->get('all');
    }

    public function publicGamesById()
    {
        $publicGames = $this->listOfPublicGames();
        $gamesById = [];

        foreach ($publicGames as $game) {
            $gamesById[$game->id] = $game->name;
        }

        return $gamesById;
    }


    public function search($name, $options)
    {
        $this->setSelectFields('id', 'name', 'year', 'note');

        $searchParams = [
            [
                'field' => 'name',
                'type' => PDO::PARAM_STR,
                'value' => '%' . $name . '%',
                'operator' => 'LIKE'
            ],
            [
                'field' => 'note',
                'operator' => '>='
            ],
            ['field' => 'platform_id'],
            ['field' => 'publisher_id'],
            ['field' => 'family_id']
        ];

        foreach($searchParams as $param){
            $type = $param['type'] ?? PDO::PARAM_INT;
            $operator = $param['operator'] ?? '=';
            $value = $param['value'] ?? $options[$param['field']];

            if($value != 0 && $value != ''){
                $this->addWhereFields($param['field'], $value, $operator, $type);
            }
        }

        $this->addWhereFields('public', 1);
        $this->addOrder('name');

        return $this->get('all');
    }

    // Méthode du coeur du système
    public function populate($id)
    {
        if (parent::populate($id)) {
            // Si j'arrive à "garnir" Game, je peux alors "garnir"
            // les modèles associés
            $this->Platform = new Platform($this->platform_id);
            $this->Publisher = new Publisher($this->publisher_id);
            $this->Family = new Family($this->family_id);
        }
    }
}