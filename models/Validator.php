<?php

define('PROCESS_FORM', 'FORM');
define('PROCESS_FORM_SESSION', 'form_');


class Validator
{

    private $data;
    private $urlError;
    private $Alert;
    private $Orm;

    public function __construct($data, $urlError, $typeProcess = PROCESS_FORM)
    {
        $this->data = $data;
        $this->urlError = $urlError;
        $this->typeProcess = $typeProcess;

        foreach ($data as $key => $value) {
            $cleanValue = htmlentities($value);
            if ($this->typeProcess === PROCESS_FORM) {
                // dd($cleanValue); die;
                $_SESSION[PROCESS_FORM_SESSION . $key] = $cleanValue;
            }
            $this->data[$key] = $cleanValue;
        }
        // $this->Alert = new Alert;
        $this->Orm = new ORM;

    }

    public function validateEmail($field)
    {
        if (!isset($this->data[$field])) {
            die('Error [Val 001 Champ ' . $field . ' inconnu');
        }
        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            Http::setAlertAndRedirect('Mail Invalide', 'inscription.php');
        }
    }
    

    public function validateLength($field, $length)
    {
        if (!isset($this->data[$field])) {
            die('Error [Val 002 Champ ' . $field . ' inconnu');
        }
        // dd(strlen($this->data[$field]));
        // dd($length); die;
        if (strlen($this->data[$field]) < $length) {
            Http::setAlertAndRedirect('Longueur de ' . $field . ' inssufisante', 'inscription.php');
        }
    }

    public function validateNumeric($field)
    {
        if (!isset($this->data[$field])) {
            die('Error [Val 003 Champ ' . $field . ' inconnu]');
        }
        if (!is_numeric($this->data[$field])) {
            Http::setAlertAndRedirect('Vous devez passer un nombre', 'inscription.php');
        }
    }

    public function validateUnique($field, $tableAndField, $typePDO = PDO::PARAM_STR)
    {
        if (!isset($this->data[$field])) {
            die('Error [Val 004 Champ ' . $field . ' inconnu');
        }

        // 'pseudo', 'users.pseudo'
        [$table, $tableField] = explode('.', $tableAndField);

        $this->Orm->setTable($table);
        $this->Orm->addWhereFieldsAndValues($tableField, $this->data[$field], '=', $typePDO);

        if($this->Orm->get('count') != 0){
            Http::setAlertAndRedirect('Votre ' . $field . ' est déjà utilisé !', 'inscription.php');
        }
    }


    public function validatePassword($field, $lengthRequire)
    {
        $this->validateLength($field, $lengthRequire);

        $lettres = 'abcdefghijklmnopqrstuvwxyz';
        $containLettres = false;
        $chiffres = '0123456789';
        $containChiffres = false;
        $speciaux = '*+-()[]{}$!.?=';
        $containSpeciaux = false;

        // dd($password);
        $pass = strtolower($this->data[$field]);
        $length = strlen($this->data[$field]);

        for($i = 0; $i < $length; $i++){
            if(strpos($lettres, $pass[$i]) !== false){
                $containLettres = true;
                continue;
            }
            if(strpos($chiffres, $pass[$i]) !== false){
                $containChiffres = true;
                continue;
            }
            if(strpos($speciaux, $pass[$i]) !== false){
                $containSpeciaux = true;
            }
        }

        if(!($containLettres && $containChiffres && $containSpeciaux)){
            Http::setAlertAndRedirect('Mots de posse doit contenir 8 caractère dont 1 special, 1 chiffre et 1 alphabétique', 'inscription.php');
        }
    }


    public function crypt($field){
        $this->data[$field] = md5($this->data[$field]);
    }

    public function getData()
    {
        return $this->data;
    }

}
