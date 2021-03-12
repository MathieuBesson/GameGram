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

        $this->addWhereFields('name', '%' . $name . '%', 'LIKE', PDO::PARAM_STR);

        if(isset($options['platform_id']) && $options['platform_id'] != 0){
            $this->addWhereFields('platform_id', $options['platform_id']);
        }

        if(isset($options['publisher_id']) && $options['publisher_id'] != 0){
            $this->addWhereFields('publisher_id', $options['publisher_id']);
        }

        if(isset($options['family_id']) && $options['family_id'] != 0){
            $this->addWhereFields('family_id', $options['family_id']);
        }

        if(isset($options['note'])){
            $this->addWhereFields('note', $options['note'], '>=');
        }


        $this->addWhereFields('public', 1);
        $this->addOrder('name');

        return $this->get('all');
    }

    public function getSuggestGames()
    {
        $games = [];

        // Collections (Posts, likes, Comments)

        // Jeux utilisés dans les posts, likes et commentés 
        $post = new Post();


        dd($post->fieldOftable('game_id')); 

        
        $postsId = (new Comment)->fieldOftable('post_id'); 

        foreach($postsId as $postId){

            // $post->addWhereFields('id', );
        }


        dd((new Like)->fieldOftable('post_id', false)); 


        die;

        dd(array_unique(array_column((new Like())->fieldOftable('game_id'), 'game_id'))); 

        
        
        
        die;






        // Jeux de la console la plus représenté dans les suggestions et de l'éditeur et de la famille --> intersection

        
        
        // Vérifier que les suggestions ne sont pas dans la collection => ORM --> IN (toute les id collection)
        
        return $games;
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