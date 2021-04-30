<?php
namespace App;

class Autoloader
{
    static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class)
    {
        // On récupère dans $class la totalité du namespace de la classe concernée (App\Client\Compte)
        // On retire App\ (Client\Compte)
        $class = str_replace('App', '..', $class);
        
        // On remplace les \ par des /
        $class = str_replace('\\', '/', $class);

        $fichier = $class . '.php';
        // On vérifie si le fichier existe
        if(file_exists($fichier)){
            require_once $fichier;   
        }
    }
}