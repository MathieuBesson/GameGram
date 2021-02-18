<?php

class PostsViewController extends Controller
{
    public $Game;
    public $Post;


    public function __construct()
    {
        parent::__construct();
        $this->Game = new Game();
        $this->Post = new Post();
        $this->User = new User();
        $this->notAllowIfNotLogged();
    }

    public function feed()
    {
        return [
            'title' => 'Feed',
            'description' => 'Derniers posts de ' . NAME_APPLICATION . ' !',
            'posts' => $this->Post->lastPostsWithGameAndUser()
        ];
    }


    public function create()
    {
        return [
            'title' => 'Nouveau Post',
            'description' => 'Nouveau Post pour ' . NAME_APPLICATION . ' !',
            'gamesById' => $this->Game->publicGamesById()
        ];
    }


    public function post()
    {

        $this->Post->populate(Router::get('id', 'is_numeric'));

        $this->Post->loadComments(10);

        if (!$this->Post->exist()) {
            $this->Alert->setAlert('Ce Post n\'existe pas');
            $this->Alert->redirect('feed.php');
        }


        return [
            'title' => $this->Post->title,
            'description' => substr($this->Post->content, 0, 240) . '...',
            'post' => $this->Post
        ];
    }

    public function feed_user()
    {
        $this->User->populate(Router::get('id', 'is_numeric'));

        return [
            'title' => $this->User->pseudo,
            'description' => 'Derniers posts de ' . $this->User->pseudo . ' !',
            'member' => $this->User
        ];
    }
}
