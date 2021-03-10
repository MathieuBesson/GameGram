<?php 

class GamesViewController extends Controller
{
    public $Game;

    public function __construct()
    {
        parent::__construct();
        $this->Game = new Game();
    }

    public function acceuil()
    {
        return [
            'title' => 'Acceuil', 
            'description' => 'Un tout nouveau réseau social centré sur l\'univers des jeux-vidéos Multijoueurs !'
        ];
    }

    public function presentation()
    {
        return [
            'title' => 'Présentation', 
            'description' => 'Présentation de ' . NAME_APPLICATION
        ];
    }

    public function all()
    {
        return [
            'title' => 'Jeux', 
            'description' => 'Les jeux de ' . NAME_APPLICATION,
            'listOfGames' => $this->Game->listOfPublicGames()
        ];
    }


    public function one()
    {
        $this->Game->populate(Router::get('id', 'is_numeric'));
    
        if (!$this->Game->exist()) {
            $this->Alert->setAlert('Ce jeu n\'existe pas');
            $this->Alert->redirect(['dir' => 'games', 'page' => 'all']);
        }
        
        return [
            'title' => $this->Game->name, 
            'description' => 'Présentation de ' . $this->Game->name,
            'jeu' => $this->Game
        ];
    }


    public function search()
    {
        $games = [];
        // dd($_GET); die;
        if(Router::check('name')){

            $name = Router::get('name', 'is_string');
            $publisherId = Router::get('publisher_id', 'is_numeric');
            $familyId = Router::get('family_id', 'is_numeric');
            $platformId = Router::get('platform_id', 'is_numeric');
            $note = Router::get('note', 'is_numeric');

            $games = $this->Game->search(
                $name,
                [
                    'publisher_id' => $publisherId,
                    'family_id' => $familyId,
                    'platform_id' => $platformId,
                    'note' => $note
                ]
            );
        } 


        return [
            'games' => $games,
            'publishers' => $this->Game->Publisher->getList(),
            'families' => $this->Game->Family->getList(),
            'platforms' => $this->Game->Platform->getList(),


            'title' => 'Recherche', 
            'description' => 'Rechercher',
            // 'listOfGames' => $this->Game->listOfGamesWithTri()
        ];
    }
}