<?php
// Menu
$html->addMenu('Présentation', Router::urlView('games', 'presentation'));
$html->addMenu('Jeux', Router::urlView('games', 'all'));

if ($Auth->logged) {
    $html->addMenu('Feed', Router::urlView('posts', 'feed'));
    $html->addMenu('Mes posts', Router::urlView('posts', 'feed_user', ['id' => $Auth->User->id]));

    $html->addMenu('Mon compte', Router::urlView('users', 'mon_compte'));
    $html->addMenu('Déconnexion', Router::urlProcess('users', 'logout'));
} else {
    $html->addMenu('Inscription', Router::urlView('users', 'inscription'));
    $html->addMenu('Connexion', Router::urlView('users', 'connexion'));
}

$html->setDisplayRecherche(false);