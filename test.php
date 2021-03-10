<?php
require('loader.php');


$urls = [
    ['dir' => '', 'page' => '', 'options' => [], 'result' => 'index.php'],
    ['dir' => 'games', 'page' => 'jeux', 'options' => [], 'result' => 'index.php?dir=games&page=jeux'],
    ['dir' => 'games', 'page' => 'un_jeu', 'options' => ['id' => 3], 'result' => 'index.php?dir=games&page=un_jeu&id=3'],
];

foreach($urls as $url){
    $result = Router::url(
        $url['dir'], 
        $url['page'],
        $url['options']
    );

    echo $result . '<br>';

    if($result == $url['result']){
        echo 'OK';
    } else {
        echo 'NULLL';
    }
}


//dad@mail.com
//ttM5.....