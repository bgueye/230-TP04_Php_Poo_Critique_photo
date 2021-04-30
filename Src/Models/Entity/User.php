<?php

namespace App\Src\Models\Entity;

use App\Src\Models\Model;

class User extends Model
{
    protected $id_user; 
    protected $login;
    protected $psw;
    protected $pseudo;
    protected $roles;
}
