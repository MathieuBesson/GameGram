<?php

class Family extends ORM
{

    public function __construct($id = null)
    {
        parent::__construct();
        $this->setTable('families');

        if ($id != null) {
            $this->populate($id);
        }
    }

    public function create($name)
    {
        $this->addInsertField('name', $name, PDO::PARAM_STR);
        // TODO : faire la fonction insert
        // TODO : retourne le nouvel id créé
        $newId = $this->insert();
        $this->populate($newId);
    }
}


$family = new Family();

$family->create('bdjddsd');
$family->create('bdjddsd');



$family->launch();
