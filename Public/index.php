<?php
use App\Autoloader;
use App\Src\Core\Main;
use App\Src\Exceptions\NotFoundException;

define('ROOT', __DIR__);

// On importe l'autoloader
require_once '../Autoloader.php';
Autoloader::register();

try {
// On instancie Main (le routeur)
$app = new Main();

// On démarre l'application
$app->start();
}catch(NotFoundException $e){
    return $e->erreur404();
}