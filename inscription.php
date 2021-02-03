<?php
include('loader.php');

$html = new Bootsrap('Acceuil', 'Bienvenue sur ' . APP_NAME . ' !', 'fr');
$inscriptionForm = new BootstrapForm('Inscription new utilisateur', 'inscription.php');
$connexionForm = new BootstrapForm('Inscription new utilisateur', 'inscription.php');


// Start DOM HTML
echo $html->startDOM();

// Menu 
$html->addMenu('Presentation', 'presentation.php');
$html->addMenu('Jeux', 'jeux.php');
$html->addMenu('Inscription', 'inscription.php');
$html->setDisplayResearch(false);

echo $html->menu();


// Main content
echo $html->startMain();

$inscriptionForm->addInput('username', TYPE_EMAIL, ['label' => 'Adresse mail', 'placeholder' => 'maroucam35@gmail.com']);
$inscriptionForm->addInput('password', TYPE_PASSWORD, ['label' => 'Mot de passe', 'placeholder' => '8 caractères minimum']);
$inscriptionForm->addInput('pseudo', TYPE_TEXT, ['label' => 'Pseudo', 'placeholder' => 'maroucam35']);
$inscriptionForm->addInput('number-of-games', TYPE_NUMBER, ['label' => 'Nombre de Jeux', 'min' => '0', 'placeholder' => '10', 'max' => '1000']);
$inscriptionForm->setSubmit('Je m\'inscris', ['color' => WARNING]);

$connexionForm->addInput('username', TYPE_EMAIL, ['label' => 'Adresse mail', 'placeholder' => 'maroucam35@gmail.com']);
$connexionForm->addInput('password', TYPE_PASSWORD, ['label' => 'Mot de passe', 'placeholder' => '********']);
$connexionForm->setSubmit('Je me connecte', ['color' => WARNING]);

?>


<div class="starter-template  py-5 px-3">
    <h1 class="text-center"><?= APP_NAME ?></h1>
    <p class="lead text-center">Page d'inscription</p>
    <div class="d-flex justify-content-center">

        <?=  $inscriptionForm->getForm(); ?>
        <?=  $connexionForm->getForm(); ?>
    </div>



</div>


<?php
echo $html->endMain();

// End DOM HTML
echo $html->endDOM();
