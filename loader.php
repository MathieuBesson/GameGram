<?php 
session_start();
include('constantes.php');

//Utils 
include(DIR_UTILS . 'Bootstrap.php');
include(DIR_UTILS . 'BootstrapForm.php');
include(DIR_UTILS . 'BootstrapAlert.php');
include(DIR_UTILS . 'Http.php');



// Models et ORM
include(DIR_MODELS . 'ORM.php');
include(DIR_MODELS . 'Game.php');
include(DIR_MODELS . 'Platform.php');
include(DIR_MODELS . 'Family.php');
include(DIR_MODELS . 'Publisher.php');
include(DIR_MODELS . 'User.php');
include(DIR_MODELS . 'Validator.php');

include(DIR_UTILS . 'Auth.php');
$Auth = new Auth();


function dd($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}





