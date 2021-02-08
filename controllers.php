<?php
include('loader.php');

dd($_POST);

if(isset($_POST['inscription'])){
        $validator = new Validator($_POST, 'inscription.php');

        $validator->validateEmail('username');


        $validator->validateLength('pseudo', 4);

        $validator->validateNumeric('nb_games');

        $validator->validateUnique('username', 'users.username');

        $validator->validateUnique('pseudo', 'users.pseudo');

        $validator->validatePassword('password', 8);
        $validator->crypt('password');


        $dataUser = $validator->getData();


        $user = new User();

        $user->create(
            $dataUser['username'],
            $dataUser['password'],
            $dataUser['pseudo'],
            $dataUser['nb_games']
        );

        Http::setAlertAndRedirect('Connecte toi maintenant', 'connexion.php', ['color' => SUCCESS]);
}



if(isset($_POST['connexion'])){
    dd('Traitement');
        $validator = new Validator($_POST, 'connexion.php');

        $validator->validateEmail('username');
        $validator->validatePassword('password', 8);
        $validator->crypt('password');
        $dataUser = $validator->getData();


        $user = new User();

        if(!$user->login($dataUser['username'], $dataUser['password'])){
            Http::setAlertAndRedirect('Mauvaise combinaison login / Mot de passe ', 'connexion.php');
        }

        $Auth->setUser($user->id);
        Http::setAlertAndRedirect('Bienvenue ' . $Auth->User->pseudo  , 'feed.php', ['color' => SUCCESS]);
}

dd($_GET['action']);
if(isset($_GET['action']) && $_GET['action'] === 'logout'){
    $Auth->logOut();
    Http::setAlertAndRedirect('Vous avez été déconnecter', 'games.php', ['color' => SUCCESS]);

}