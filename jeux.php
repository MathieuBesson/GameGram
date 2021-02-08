<?php
include('loader.php');

$html = new Bootsrap('Acceuil', 'Bienvenue sur ' . APP_NAME . ' !', 'fr');
$games = new Game();


// Start DOM HTML
echo $html->startDOM();

// Menu 
include('elements/menu.php');


echo $html->menu();


// Main content
echo $html->startMain();

// $orm->setTable('games');
// $orm->setTypeWhere('AND');
// $orm->addWhereFieldsAndValues('note', 8, '>');
// $orm->addWhereFieldsAndValues('note', 16, '<');

// $orm->setSelectFields('name', 'id', 'year', 'note');
// $games = $orm->get(TYPE_GET_ALL);
// $nbGames = $orm->get(TYPE_GET_COUNT);
$dataGames = $games->listOfPublicGames();
$nbGames = $games->get(TYPE_GET_COUNT);
?>


<div class="starter-template text-center py-5 px-3">
    <h1><?= APP_NAME ?></h1>
    <p class="lead">Découvre la liste des jeux disponibles dans la base de donnée</p>
    <p>Il y a actuellement  <?= $nbGames ?> jeux dans la base </p>


    <div class="d-flex flex-wrap">
        <?php foreach ($dataGames as $item) : ?>
            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $item->name ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Note : <?= $item->note ?></h6>
                    <p class="card-text">Date de sortie <span class="badge bg-warning"><?= $item->year ?></span></p>
                    <?= $html->button('See this game' ,  'jeu.php?id=' . $item->id . '"', ['color' => WARNING]) ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>


<?php
echo $html->endMain();

// End DOM HTML
echo $html->endDOM();
