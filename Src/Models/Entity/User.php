<?php

namespace App\Src\Models\Entity;

use App\Src\Models\Model;

class User extends Model
{
    protected $id; 
    protected $login;
    protected $psw;
    protected $pseudo;
    protected $roles;
    protected $comments;
    protected $photos;


    public function __construct() {
        $this->table = 'users';
        $this->comments = new \ArrayObject;
        $this->photos = new \ArrayObject;
    }

    function getIdUser() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getPsw() {
        return $this->psw;
    }

    function getPseudo() {
        return $this->pseudo;
    }

    function getRoles() {
        return $this->roles;
    }

    function setIdUser($id_user): void {
        $this->id = $id_user;
    }

    function setLogin($login): void {
        $this->login = $login;
    }

    function setPsw($psw): void {
        $this->psw = $psw;
    }

    function setPseudo($pseudo): void {
        $this->pseudo = $pseudo;
    }

    function setRoles($roles): void {
        $this->roles = $roles;
    }


    
}
