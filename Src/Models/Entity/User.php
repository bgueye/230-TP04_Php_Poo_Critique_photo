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

    public function getLogin() {
        return $this->login;
    }

    public function getPsw() {
        return $this->psw;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function setIdUser($id_user): void {
        $this->id = $id_user;
    }

    public function setLogin($login): void {
        $this->login = $login;
    }

    public function setPsw($psw): void {
        $this->psw = $psw;
    }

    public function setPseudo($pseudo): void {
        $this->pseudo = $pseudo;
    }

    public function setRoles($roles): void {
        $this->roles = $roles;
    }

    public function create()
    {
       
        $champs = [];
        $inter = [];
        $valeurs = [];

        // On boucle pour les propriétés pour les mettre dans un tableau
        foreach ($this as $champ => $valeur) {
            if ($valeur !== null && $champ != 'db' && $champ != 'table' && $champ != 'comments' && $champ != 'photos') {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }
        
        // On transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);
        var_dump($liste_champs);
        // On exécute la requête
        return $this->requete('INSERT INTO ' . $this->table . ' (' . $liste_champs . ') VALUES (' . $liste_inter . ')', $valeurs);   
    }

    public function update()
    {
        $champs = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach ($this as $champ => $valeur) {
            // UPDATE annonces SET titre = ?, description = ?, actif = ? WHERE id= ?
            if ($valeur !== null && $champ != 'db' && $champ != 'table' && $champ != 'comments' && $champ != 'photos') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $this->id;

        // On transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(', ', $champs);

        // On exécute la requête
        return $this->requete('UPDATE ' . $this->table . ' SET ' . $liste_champs . ' WHERE id = ?', $valeurs);
    }
    
}
