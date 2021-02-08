<?php
include('loader.php');

if($Auth->logged){
    Http::setAlertAndRedirect('Tu est déjà connecter', 'jeux.php', ['color' => SUCCESS]);
}


$html = new Bootsrap('Acceuil', 'Bienvenue sur ' . APP_NAME . ' !', 'fr');
$connexionForm = new BootstrapForm('Connexion', 'controllers.php');
// $connexionForm = new BootstrapForm('Inscription new utilisateur', 'controllers.php');


// Start DOM HTML
echo $html->startDOM();

// Menu 

include('elements/menu.php');


echo $html->menu();

// Main content
echo $html->startMain();

$connexionForm->addInput('username', TYPE_EMAIL, ['label' => 'Adresse mail', 'placeholder' => 'maroucam35@gmail.com']);
$connexionForm->addInput('password', TYPE_PASSWORD, ['label' => 'Mot de passe', 'placeholder' => '8 caractères minimum']);
$connexionForm->setSubmit('Je me connecte', ['color' => WARNING]);

// $connexionForm->addInput('username', TYPE_EMAIL, ['label' => 'Adresse mail', 'placeholder' => 'maroucam35@gmail.com']);
// $connexionForm->addInput('password', TYPE_PASSWORD, ['label' => 'Mot de passe', 'placeholder' => '********']);

?>


<div class="starter-template  py-5 px-3">
    <h1 class="text-center"><?= APP_NAME ?></h1>
    <p class="lead text-center">Page de connexion</p>
    <div class="d-flex justify-content-center">

        <?=  $connexionForm->getForm(); ?>
    </div>
</div>


<?php
echo $html->endMain();

// End DOM HTML
echo $html->endDOM();
