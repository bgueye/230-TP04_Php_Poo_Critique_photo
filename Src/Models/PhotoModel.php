<?php

namespace App\Src\Models;

use App\Src\Models\Entity\Photo;

/**
 * PhotoModel Contient toutes les requêtes spécifiques liées à la table photo
 *
 * @author Boubacar
 */
class PhotoModel extends Photo
{
    public function listPhotos() {
        $photos = $this->findAll();
        return $photos;
    }
  
    
}
