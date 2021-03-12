<?php

class CollectionsProcessController extends Controller
{
    public $Collection;

    public function __construct()
    {
        parent::__construct();
        $this->Collection = new Collection();
    }


    public function addToCollection()
    {
        $validator = new Validator($_POST, ['dir' => 'games', 'page' => 'search']);
        $validator->validateNumeric('game_id');
        $validator->validateExist('game_id', 'games.id');
        
        $data = $validator->getData();
        
        if ($this->Collection->alreadyCollected($data['game_id'], $this->Auth->User->id)) {
            $this->Alert->setAlert('Ce jeu est déjà dans ta collection !', ['color' => DANGER]);
            $this->Alert->redirect(['url' => $_SERVER['HTTP_REFERER']]);
        }
        // dd($_POST); die;

        $this->Collection->create(
            $this->Auth->User->id, 
            $data['game_id'],
        );

        $this->Alert->setAlert('Jeu collectionnée', ['color' => SUCCESS]);
        $this->Alert->redirect(['url' => $_SERVER['HTTP_REFERER']]);
    }
}