<?php
class User extends ORM
{
    public $Posts = [];
    public $Comments = [];

    public function __construct($id = null)
    {
        parent::__construct();
        $this->setTable('users');

        if ($id != null) {
            $this->populate($id);
        }
    }

    public function create($username, $password, $pseudo, $nbJeux)
    {
        $this->addInsertFields('username', $username, PDO::PARAM_STR);
        $this->addInsertFields('password', $password, PDO::PARAM_STR);
        $this->addInsertFields('pseudo', $pseudo, PDO::PARAM_STR);
        $this->addInsertFields('nb_games', $nbJeux, PDO::PARAM_INT);
        $this->addInsertFields('created', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        
        $newId = $this->insert();
        $this->populate($newId);
    }

    public function login($username, $cryptedPassword)
    {
        $this->addWhereFields('username', $username, '=', PDO::PARAM_STR);
        $this->addWhereFields('password', $cryptedPassword, '=', PDO::PARAM_STR);
        $this->setSelectFields('id');

        $user = $this->get('first');

        if (!empty($user)) {
            $this->populate($user['id']);
            return true;
        }
        
        return false;
    }



    public function changeInformations($id, $datas)
    {
        foreach($datas as $key => $valueArr){
            if($valueArr['value'] !== ''){
                $this->addUpdateFields($key, $valueArr['value'], $valueArr['type']);
            }
        }

        $this->addWhereFields('id', $id, '=', PDO::PARAM_STR);
        
        $newId = $this->update();
        $this->populate($newId);
    }

    public function loadLastPosts(){
        $post = new Post();
        $this->Posts = $post->lastPostsWithGameAndUserById($this->id);
    }

    public function loadLastComments(){
        $comment = new Comment();
        $this->Comments = $comment->lastCommentsWithGameAndUserById($this->id);
    }

    public function loadPostsAndComments()
    {
        $this->loadLastPosts();
        $this->loadLastComments();

        $postsAndComments = [...$this->Posts, ...$this->Comments];

        usort($postsAndComments,  function($a, $b) {
            return strtotime($a->created) <=> strtotime($b->created);
        });

        return $postsAndComments;
    }
}