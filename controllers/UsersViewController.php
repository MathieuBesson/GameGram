<?php

class UsersViewController extends Controller
{
    public $User;

    public function __construct()
    {
        parent::__construct();
        $this->User = new User();
    }

    public function inscription()
    {
        $this->notAllowIfLogged();
        return [
            'title' => 'Inscription', 
            'description' => 'Page d\'inscription de ' . NAME_APPLICATION
        ];
    }

    public function connexion()
    {

        $this->notAllowIfLogged();
        return [
            'title' => 'Connexion', 
            'description' => 'Page de connexion de ' . NAME_APPLICATION
        ];
    }


    public function mon_compte()
    {
        $this->notAllowIfNotLogged();
        
        return [
            'title' => 'Mon compte : ' . $this->Auth->User->pseudo, 
            'description' => 'Inscription '. NAME_APPLICATION .' !'
        ];
    }

}
