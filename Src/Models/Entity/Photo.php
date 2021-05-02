<?php

namespace App\Src\Models\Entity;

use App\Src\Models\Model;

class Photo extends Model
{
    private $id;
    private $titlePhoto;
    private $nameFile;
    private $postedAt;
    private $publication;
    private $user;
    private $comments;
    
    public function __construct() {
        $this->table = 'photos';
        $this->postedAt = new \Datetime(); // Par défaut, la date d'ajout est la date d'aujourd'hui
        $this->publication = true;
        $this->comments = new \ArrayObject;
    
    }
    
    function getIdPhoto() {
        return $this->id;
    }

    function getTitlePhoto() {
        return $this->titlePhoto;
    }

    function getNameFile() {
        return $this->nameFile;
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
        $this->titlePhoto = $titlePhoto;
    }

    function setNameFile($nameFile): void {
        $this->nameFile = $nameFile;
    }

    function setPostedAt($postedAt): void {
        $this->postedAt = $postedAt;
    }

    function setPublication($publication): void {
        $this->publication = $publication;
    }
    
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }
    public function getUser()
    {
        return $this->user;
    }
    



}