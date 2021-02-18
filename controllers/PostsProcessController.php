<?php

class PostsProcessController extends Controller
{
    public $Post;

    public function __construct()
    {
        parent::__construct();
        $this->Post = new Post();
    }


    public function nouveauPost()
    {

        $validator = new Validator($_POST, ['dir' => 'posts', 'page' => 'create']);

        $validator->validateLength('title', 10);

        $validator->validateLength('content', 30);

        $validator->validateNumeric('game_id');

        $data = $validator->getData();

        $this->Post->create(
            $this->Auth->User->id,
            $data['game_id'],
            $data['title'],
            $data['content']
        );

        $this->Alert->setAlert('Post créé avec succès !', ['color' => SUCCESS]);
        $this->Alert->redirect(['dir' => 'posts', 'page' => 'feed']);
    }


    public function nouveauLike()
    {

        $validator = new Validator($_POST, ['dir' => 'posts', 'page' => 'feed']);
        $validator->validateNumeric('post_id');
        $validator->validateExist('post_id', 'posts.id');

        $data = $validator->getData();
        $like = new Like();

        // dd($_SERVER['HTTP_REFERER']); die;

        // Rajouté un controle sur le fait que le post soit déjà liké ?
        if ($like->alreadyLike($data['post_id'], $this->Auth->User->id)) {
            $this->Alert->setAlert('Ce Post est déjà liké', ['color' => DANGER]);
            $this->Alert->redirect(['url' => $_SERVER['HTTP_REFERER'] . '#post_' . $data['post_id']]);
        }

        $like->create(
            $this->Auth->User->id, // Accès direct ici au User.id
            $data['post_id'],
        );

        $this->Alert->setAlert('Post liké', ['color' => SUCCESS]);
        $this->Alert->redirect(['url' => $_SERVER['HTTP_REFERER'] . '#post_' . $data['post_id']]);
    }



    public function nouveauUnlike()
    {
        $validator = new Validator($_POST, ['dir' => 'posts', 'page' => 'feed']);
        $validator->validateNumeric('post_id');
        $validator->validateExist('post_id', 'posts.id');

        $data = $validator->getData();
        $like = new Like();

        // Rajouté un controle sur le fait que le post soit déjà liké ?
        if (!$like->alreadyLike($data['post_id'], $this->Auth->User->id)) {
            $this->Alert->setAlert('Ce Post n\'est déjà pas liké', ['color' => DANGER]);
            $this->Alert->redirect(['url' => $_SERVER['HTTP_REFERER'] . '#post_' . $data['post_id']]);
        }

        $like->deleteLike(
            $this->Auth->User->id, // Accès direct ici au User.id
            $data['post_id'],
        );

        $this->Alert->setAlert('Post unliké', ['color' => SUCCESS]);
        $this->Alert->redirect(['url' => $_SERVER['HTTP_REFERER'] . '#post_' . $data['post_id']]);
    }
}
