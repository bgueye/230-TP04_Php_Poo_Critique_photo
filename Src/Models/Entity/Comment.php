<?php

namespace App\Src\Models\Entity;

use App\Src\Models\Model;

class Comment extends Model
{
    private  $id;
    private $contenu;
    private $createAt;
    private $visible;
    private $user;
    private $photo;
    
    public function __construct() {
        $this->table = 'comments';
        $this->createAt = new \Datetime(); // Par défaut, la date d'ajout est la date d'aujourd'hui
        $this->visible = true;
    }
    
    function getIdComment() {
        return $this->id;
    }

    function getContenu() {
        return $this->contenu;
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
        $this->contenu = $contenu;
    }

    function setCreateAt($createAt): void {
        $this->createAt = $createAt;
    }

    function setVisible($visible): void {
        $this->visible = $visible;
    }

        
    public function setPhoto(Photo $photo)
    {
        $this->photo = $photo;

        return $this;
    }
    
    public function getPhoto()
    {
        return $this->photo;
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