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
        $photos = $this->requete('SELECT comments.*, users.pseudo, users.login FROM comments, users WHERE comments.id_user = users.id AND comments.id_photo = '.$id);
        return $photos->fetchAll();
    }
}
