<?php

namespace App\Src\Models\Entity;

use App\Src\Models\Model;

class Photo extends Model
{
    private $id;
    private $title_photo;
    private $name_file;
    private $postedAt;
    private $publication;
    private $id_user;
    
    public function __construct() {
        $this->table = 'photos';
        $this->postedAt = new \Datetime(); // Par défaut, la date d'ajout est la date d'aujourd'hui
        $this->publication = true;
    
    }
    
    function getIdPhoto() {
        return $this->id;
    }

    function getTitlePhoto() {
        return $this->title_photo;
    }

    function getNameFile() {
        return $this->name_file;
    }

    function getPostedAt() {
        return $this->postedAt;
    }

    function getPublication() {
        return $this->publication;
    }

    function setIdPhoto($idPhoto): void {
        $this->id = $idPhoto;
    }

    function setTitlePhoto($titlePhoto): void {
        $this->title_photo = $titlePhoto;
    }

    function setNameFile($nameFile): void {
        $this->name_file = $nameFile;
    }

    function setPostedAt($postedAt): void {
        $this->postedAt = $postedAt;
    }

    function setPublication($publication): void {
        $this->publication = $publication;
    }
    
    public function setidUser($user)
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
            if ($valeur !== null && $champ != 'db' && $champ != 'table' && $champ != 'postedAt' && $champ != 'publication') {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }
        
        // On transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);
        //var_dump($liste_champs);
        //var_dump($liste_inter);
        // On exécute la requête
        return $this->requete('INSERT INTO ' . $this->table . ' (' . $liste_champs . ') VALUES (' . $liste_inter . ')', $valeurs);   
    }

}