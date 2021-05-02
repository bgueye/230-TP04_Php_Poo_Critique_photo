<?php
namespace App\Src\Controllers;

/**
 * MainController gère la page d'accueil et les autres pages
 * telles que Contact, CGV...
 *
 * @author Boubacar
 */
class MainController extends Controller {
    
    public function index() {
        
        $this->render('index');
    }
    
    
}
