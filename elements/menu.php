<?php 


$html->addMenu('Presentation', 'presentation.php');
$html->addMenu('Jeux', 'jeux.php');

if($Auth->logged){
    $html->addMenu('Deconnection', 'controllers.php?action=logout');
    $html->addMenu('Feed', 'feed.php');

} else {
    $html->addMenu('Inscription', 'inscription.php');
    $html->addMenu('Connexion', 'connexion.php');
}
    

$html->setDisplayResearch(false);