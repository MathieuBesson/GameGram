<?php 

class Controller
{
    public $Auth;
    public $Alert;

    public function __construct()
    {
        $this->Auth = new Auth();
        $this->Alert = new Alert();
    }

    public function notAllowIfLogged($paramsLink =  ['dir' => 'posts', 'page' => 'feed'])
    {
        if ($this->Auth->logged) {
            $this->Alert->setAlert('Tu es déjà connecté !', ['color' => DANGER]);
            $this->Alert->redirect($paramsLink);
        }
    }

    public function notAllowIfNotLogged($paramsLink = ['dir' => 'posts', 'page' => 'inscription'])
    {
        if (!$this->Auth->logged) {
            $this->Alert->setAlert('Tu n\'est pas connecté, tu n\'a pas accès à cette page !', ['color' => DANGER]);
            $this->Alert->redirect($paramsLink);
        }
    }

}