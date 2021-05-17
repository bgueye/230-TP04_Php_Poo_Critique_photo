<?php

namespace App\Src\Core;

use Exception;
use App\Src\Exceptions\NotFoundException;

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
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        //On instancie le controleur,
        $controller = '\\App\\Src\\Controllers\\' . ucfirst($entite) . 'Controller';
        if (!class_exists($controller)){
            throw new NotFoundException();
        }
        $controller = new $controller();
        
        //puis on exécute la mèthode concernée si elle existe
        if (!method_exists($controller, $action)){
            //heaider('Location:')
            throw new NotFoundException();
        }
        if (!empty($id)) {
            $controller->$action($id);
        } else {
            $controller->$action();
        }
    }

}
