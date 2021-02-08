<?php 

class User extends ORM
{

    public function __construct($id = null)
    {
        parent::__construct();
        $this->setTable('users');

        if ($id != null) {
            $this->populate($id);
        }
    }


    public function create($username, $password, $pseudo, $nbGames){
        $this->addInsertField('username', $username, PDO::PARAM_STR);
        $this->addInsertField('password', $password, PDO::PARAM_STR);
        $this->addInsertField('pseudo', $pseudo, PDO::PARAM_STR);
        $this->addInsertField('nb_games', $nbGames, PDO::PARAM_INT);
        $this->addInsertField('created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $this->insert();
        echo 'la';
    }   


    public function login($username, $cryptedPassword){
        $this->addWhereFieldsAndValues('username', $username);
        $this->addWhereFieldsAndValues('password', $cryptedPassword);
        $this->setSelectFields('id');

        $user = $this->get('first');

        if(!empty($user)){
            $this->populate($user['id']);
            return true;
        }
        return false;
    }


}