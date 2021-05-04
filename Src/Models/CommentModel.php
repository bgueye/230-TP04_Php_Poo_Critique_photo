<?php

namespace App\Src\Models;

use App\Src\Models\Entity\Comment;

/**
 * CommentModel Contient toutes les requêtes spécifiques liées à la table comments
 *
 * @author Boubacar
 */
class CommentModel extends Comment
{
    public function findByPhotoId($id)
    {
        $photos = $this->requete('SELECT * FROM comments 
        JOIN photos ON comments.id_photo = photos.id
        WHERE comments.id_photo = '.$id);
        return $photos->fetchAll();
    }
}
