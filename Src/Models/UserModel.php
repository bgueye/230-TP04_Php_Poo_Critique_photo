<?php

namespace App\Src\Models;

use App\Src\Models\Entity\User;
use \Exception;

/**
 * UserModel Contient toutes les requêtes spécifiques liées à la table users
 *
 * @author Boubacar
 */
class UserModel extends User
{
    public function verifUser(User $user) : void {
        //var_dump($user);
        //die();
        $userBdd = $this->findByLogin($user->login);

        if(password_verify($user->psw, $userBdd->psw)){
           $user->setIdUser($userBdd->id);
           $user->setPseudo($userBdd->pseudo);
           $user->setRoles($userBdd->roles);
           $user->setPsw($userBdd->psw);
        } else {
           throw new Exception('Erreur mot de passe');
        }
    }


    

}
