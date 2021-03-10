<?php
include('loader.php');

// param correspondant à la vue souhaitez
$dir = $_GET['dir'] ?? 'games';
$page = $_GET['page'] ?? 'acceuil';

$controller = ucfirst($dir) . 'ViewController';


Router::controlFile(DIR_CONTROLLERS, $controller);

$call = new $controller;

Router::controlMethod($controller, $page);

$data = $call->{$page}();



foreach($data as $name => $value){
    $variableName = '_' . $name;
    ${$variableName} = $value ;
}


Router::controlFile(DIR_VIEWS . $dir . DIRECTORY_SEPARATOR , $page);

include(DIR_VIEWS . 'Templates/front.php');
