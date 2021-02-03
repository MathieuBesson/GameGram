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
        if ($id != null) {
            $this->populate($id);
        }
    }

    protected function populate($id)
    {
        if (parent::populate($id)) {
            $this->Platform = new Platform($this->platform_id);
            $this->Family = new Family($this->family_id);
            $this->Publisher = new Publisher($this->publisher_id);
        }
    }



    public function listOfPublicGames()
    {
        $this->setTable('games');
        $this->addOrderByFieldAndDirection('id', 'DESC');
        $this->setSelectFields('name', 'id', 'year', 'note');
        return $this->get(TYPE_GET_ALL);
    }
}
