<?php
include('loader.php');

$html = new Bootsrap('Acceuil', 'Bienvenue sur ' . APP_NAME . ' !', 'fr');

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
    <h1><?= APP_NAME ?></h1>
    <p class="lead">Le réseaux social favoris des vrais GAMMERS<br> Rejoinds nous vite !</p>
    <?= $html->image('star-wars.jpg', ['alt' => 'Maginifique image d\'un stormtrooper', 'width' => "40%", "class" => 'rounded mb-4']) ?>
    <p><?= $html->button('Inscription', 'inscription.php', ['color' => PRIMARY . ' mr-5']) ?>
    <?= $html->button('Presentation', 'presentation.php', ['color' => SUCCESS]) ?></p>


</div>


<?php
echo $html->endMain();

// End DOM HTML
echo $html->endDOM();
