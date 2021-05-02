<?php


namespace App\Src\Controllers;

use App\Src\Models\PhotoModel;
use App\Src\Models\Entity\Photo;
/**
 * PhotoController pour le traitement des photos et commentaies
 *
 * @author Boubacar
 */
class PhotoController extends Controller {
    
    public function index() {
        
        $model = new PhotoModel();
        $photos = $model->listPhotos();
        //var_dump($photos);
        $this->render('photo/viewPhoto', ['photos' => $photos]);
    }
    
    public function voir($id) {
        $model = new PhotoModel();
        $photo = $model->find($id);
        
        //$tab = get_object_vars($photo);
        
        $this->render('photo/voirPhoto', ['photo' => $photo]);
    }
    
    public function newComment() {
        
    }

    public function newPhoto(){
        
    }
}
