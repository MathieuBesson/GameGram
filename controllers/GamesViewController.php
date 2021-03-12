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

        // Form défault values
        $name = '';
        $publisherId = 0;
        $familyId = 0;
        $platformId = 0;
        $note = 0;
        $search = false;


        if (Router::check('name')) {
            $search = true;
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

            'search_name' => $name,
            'search_publisher_id' => $publisherId,
            'search_family_id' => $familyId,
            'search_platform_id' => $platformId,
            'search_note_id' => $note,

            'collection' => (new Collection)->collectionOfUser($this->Auth->User->id),

            'title' => 'Recherche',
            'description' => 'Rechercher',
        ];
    }


    public function suggest()
    {
        $this->notAllowIfNotLogged();
        return [
            'games' => $this->Game->getSuggestGames(),
            'title' => 'Suggestion de jeux',
            'description' => 'Chercher un jeu dans la abse de données'
        ];
    }
}
