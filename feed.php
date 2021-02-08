<?php
include('loader.php');

if(!$Auth->logged){
    Http::setAlertAndRedirect('Tu dois être connecter pour acceder au feed', 'jeux.php', ['color' => SUCCESS]);
}


$html = new Bootsrap('Acceuil', 'Bienvenue sur ' . APP_NAME . ' !', 'fr');
// $connexionForm = new BootstrapForm('Inscription new utilisateur', 'controllers.php');


// Start DOM HTML
echo $html->startDOM();
// Menu 
include('elements/menu.php');

echo $html->menu();
// Main content
echo $html->startMain();


?>


<div class="starter-template  py-5 px-3">
    <h1 class="text-center"><?= APP_NAME ?></h1>
    <p class="lead text-center">Page de feed</p>
    <div class="d-flex justify-content-center">

    </div>
</div>


<?php
echo $html->endMain();

// End DOM HTML
echo $html->endDOM();

