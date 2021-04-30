<?php

namespace App\Src\Core;

use App\Src\Controllers\MainController;


/**
 * Routeur principal
 */
class Main
{
    public function start()
    {
        // On démarre la session
        session_start();

        // On gère les paramètres d'URL
        // p=controleur/methode/paramètres
        // On sépare les paramètres dans un tableau
        $param = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_SPECIAL_CHARS);    
        $params = [];
        if(isset($param)){
            $params = explode('/', $param);
        }
        // var_dump($params);
        if(isset($params[0]) && $params[0] != ''){
            // On a au moins 1 paramètre, on récupère le nom du contrôleur à instancier
            // On met une majuscule en 1ère lettre, on ajoute le namespace complet avant et on ajoute "Controller" après
            $controller = 'App\\Src\\Controllers\\'.ucfirst(array_shift($params)).'Controller';
            // On instancie le contrôleur
            $controller = new $controller();

            // On récupère le 2ème paramètre d'URL
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            if(method_exists($controller, $action)){
                // Si il reste des paramètres on les passe à la méthode
                (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
            }else{
                http_response_code(404);
                echo "La page recherchée n'existe pas";
            }

        }else{
            // On n'a pas de paramètres
            // On instancie le contrôleur par défaut
            $controller = new MainController;
            
            // On appelle la méthode index
            $controller->index();
        }
    }
}