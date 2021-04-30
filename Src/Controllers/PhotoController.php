<?php


namespace App\Src\Controllers;

/**
 * PhotoController pour le traitement des photos et commentaies
 *
 * @author Boubacar
 */
class PhotoController extends Controller {
    
    public function index() {
        
        $this->render('photo/viewPhoto');
    }
    
    public function voir($id) {
        
         $this->render('photo/voirPhoto');
    }
    
    public function comment() {
        
    }
}
