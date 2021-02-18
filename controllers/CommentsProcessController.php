<?php
//5555555.M
class CommentsProcessController extends Controller
{
    public $Comment;

    public function __construct()
    {
        parent::__construct();
        $this->Comment = new Comment();
    }

    public function nouveauCommentaire()
    {
        $validator = new Validator($_POST, ['dir' => 'posts', 'page' => 'post', 'options' => ['id' =>  $_POST['post_id']]]);
        $validator->validateNumeric('post_id');
        $validator->validateExist('post_id', 'posts.id');
        $validator->validateLength('content', 5);
        $data = $validator->getData();

        $this->Comment->create(
            $this->Auth->User->id, // Accès direct ici au User.id
            $data['post_id'],
            $data['content']
        );

        $this->Alert->setAlert('Commentaire créé avec succès !', ['color' => SUCCESS]);
        $this->Alert->redirect(['dir' => 'posts', 'page' => 'post', 'options' => ['id' =>  $_POST['post_id']]]);
    }
}
