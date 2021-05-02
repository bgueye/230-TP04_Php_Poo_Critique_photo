<?php
use App\Autoloader;
use App\Src\Core\Main;

define('ROOT', __DIR__);

// On importe l'autoloader
require_once '../Autoloader.php';
Autoloader::register();

// On instancie Main (le routeur)
$app = new Main();

// On démarre l'application
$app->start();