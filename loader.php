<?php
// Démarrage de la session, pour utiliser $_SESSION
session_start();

// Constantes
define('DIR_CONSTANTES', 'constantes' . DIRECTORY_SEPARATOR);
require(DIR_CONSTANTES . 'systeme.php');
require(DIR_CONSTANTES . 'bootstrap.php');
require(DIR_CONSTANTES . 'session.php');


// Autoloader
spl_autoload_register(function ($class) {
    $folders = [
        DIR_MODELS,
        DIR_CONTROLLERS,
        DIR_UTILS
    ];
    foreach ($folders as $folder) {
        $fileName = $folder . $class . '.php';
        if (file_exists($fileName)) {
            require $fileName;
            return true;
        }
    }
    return false;
});


function dd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

$Design = new Design; // Disponible partout dans toutes mes pages
$Alert = new Alert; // Disponible partout dans toutes mes pages
$Auth = new Auth; // Disponible partout dans toutes mes pages
