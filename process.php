<?php
include('loader.php');

$dir = $_GET['dir'];
$page = $_GET['page'];

$controller = ucfirst($dir) . 'ProcessController';

Router::controlFile(DIR_CONTROLLERS, $controller);

$call = new $controller;

Router::controlMethod($controller, $page);

$data = $call->{$page}();