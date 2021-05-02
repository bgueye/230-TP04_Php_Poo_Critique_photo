<?php

namespace App\Src\Core;

/**
 * Routeur principal
 */
class Main {

    public function start() {
        // On démarre la session
        session_start();
        
        //On récupère les paramètres de l'uri
        $entite = !empty(filter_input(INPUT_GET, 'entite', FILTER_SANITIZE_SPECIAL_CHARS)) ? filter_input(INPUT_GET, 'entite', FILTER_SANITIZE_SPECIAL_CHARS) : 'main';
        $action = !empty(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS)) ? filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS) : 'index';
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        
        //On instancie le controleur,
        $controller = '\\App\\Src\\Controllers\\' . ucfirst($entite) . 'Controller';
        $controller = new $controller();
        
        //puis on exécute la mèthode concernée 
        if (!empty($id)) {
            $controller->$action($id);
        } else {
            $controller->$action();
        }
    }

}
