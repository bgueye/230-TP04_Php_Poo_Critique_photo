<?php

namespace App\Src\Controllers;

/**
 * UserController pour la gestion des Utilisateurs (CRUD)
 *
 * @author Boubacar
 */
class UserController extends Controller {
    
    public function index() {
        
        echo '<h1>Gestion utilisateur<h1>';
    }
    
    public function connexion() {
        
        echo '<h1>Formulaire de connexion<h1>';
    }
}
