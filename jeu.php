<?php
include('loader.php');

$html = new Bootsrap('Acceuil', 'Bienvenue sur ' . APP_NAME . ' !', 'fr');
$game = new Game($_GET['id']);


if (!$game->exist()) {
    Http::setAlertToSession('Ce jeu n\'est pas présent dans notre base');
    Http::redirect(DIR_APP . 'jeux.php');
}


// $game->addInsertField('name', 'adnank');
// $game->launch();


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

?>

<div class="starter-template text-center py-5 px-3">
    <h2><?= $game->name ?></h2>
    <p>Editeur : <?= $game->Publisher->name ?></p>
    <p>Type : <?= $game->Family->name ?></p>
    <p>Note : <?= $html->badge($game->note, ['color' => WARNING]) ?></p>
    <p>Plateform : <?= $html->badge($game->Platform->name, ['color' => WARNING]) ?></span></p>
    <p>Date de sortie <?= $html->badge($game->year, ['color' => WARNING]) ?></span></p>
</div>


<?php
echo $html->endMain();

// End DOM HTML
echo $html->endDOM();
