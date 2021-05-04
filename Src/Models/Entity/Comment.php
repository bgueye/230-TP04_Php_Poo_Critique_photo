<?php

namespace App\Src\Models\Entity;

use App\Src\Models\Model;

class Comment extends Model
{
    private  $id;
    private $comment;
    private $createAt;
    private $visible;
    private $id_user;
    private $id_photo;
    
    public function __construct() {
        $this->table = 'comments';
        $this->createAt = new \Datetime(); // Par défaut, la date d'ajout est la date d'aujourd'hui
        $this->visible = true;
    }
    
    function getIdComment() {
        return $this->id;
    }

    function getContenu() {
        return $this->comment;
    }

    function getCreateAt() {
        return $this->createAt;
    }

    function getVisible() {
        return $this->visible;
    }

    function setIdComment($idComment): void {
        $this->id = $idComment;
    }

    function setContenu($contenu): void {
        $this->comment = $contenu;
    }

    function setCreateAt($createAt): void {
        $this->createAt = $createAt;
    }

    function setVisible($visible): void {
        $this->visible = $visible;
    }

        
    public function setidPhoto($photo)
    {
        $this->id_photo = $photo;

        return $this;
    }
    
    public function getPhoto()
    {
        return $this->id_photo;
    }

    
    public function setUser($user)
    {
        $this->id_user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->id_user;
    }


    public function create()
    {
       
        $champs = [];
        $inter = [];
        $valeurs = [];

        // On boucle pour les propriétés pour les mettre dans un tableau
        foreach ($this as $champ => $valeur) {
            if ($valeur !== null && $champ != 'db' && $champ != 'table' && $champ != 'createAt') {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }
        
        // On transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);
        // On exécute la requête
        return $this->requete('INSERT INTO ' . $this->table . ' (' . $liste_champs . ') VALUES (' . $liste_inter . ')', $valeurs);   
    }
}