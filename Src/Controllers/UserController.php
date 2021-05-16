<?php

namespace App\Src\Controllers;

use Exception;
use App\Src\Core\FormBuilder;
use App\Src\Models\UserModel;
use App\Src\Models\PhotoModel;

/**
 * UserController pour la gestion des Utilisateurs (CRUD)
 *
 * @author Boubacar
 */
class UserController extends Controller
{

    public function index()
    {
        header('Location: index.php?entite=photo&action=mesPhotos');
    }

    public function connexion()
    {
        //On prépare le tocken
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;

        // On instancie le formulaire
        $form = new FormBuilder;

        // On ajoute chacune des parties qui nous intéressent
        $form->debutForm('post', 'index.php?entite=user&action=verifConnexion')
            ->ajoutLabelFor('email', 'Email')
            ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control'])
            ->ajoutLabelFor('password', 'Mot de passe')
            ->ajoutInput('password', 'password', ['id' => 'password', 'class' => 'form-control mb-3'])
            ->ajoutInput('hidden', 'token', ['value' => $token])
            ->ajoutBouton('Me connecter', ['class' => 'btn badge badge-primary'])
            ->finForm();

        // On envoie le formulaire à la vue en utilisant notre méthode "create"
        $this->render('user/formConnexion', ['loginForm' => $form->create()]);
    }

    public function verifConnexion()
    {
        $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($token == null || !hash_equals($token, $_SESSION['token'])) {
            header('Location: index.php?entite=user&action=connexion');
            die();
        }
        $login = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $psw = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $user = new UserModel;
        $user->setLogin($login);
        $user->setPsw($psw);
        $model = new UserModel;

        try {
            $model->verifUser($user);
            //var_dump($user->getLogin());
            $_SESSION['pseudo'] = $user->getPseudo();
            $_SESSION['login'] = $user->getLogin();
            $_SESSION['roles'] = $user->getRoles();
            $_SESSION['id'] = $user->getIdUser();
            
            //var_dump($_SESSION);
            //die();
            header('Location: index.php?entite=photo');
        } catch(Exception $err){
            $this->connexion();
            die();
        } 
    }

    public function deconnexion()
    {
        session_destroy();
        session_write_close();
        header('Location: index.php');
    }


    public function newUser()
    {
        if(FormBuilder::validate($_POST, ['pseudo', 'email', 'password'])){
            
            $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $psw = password_hash($_POST['password'], PASSWORD_ARGON2I);

            $user = new UserModel;

            $user->setPseudo($pseudo);
            $user->setLogin($email);
            $user->setPsw($psw);
            $user->setRoles('membre');
            $user->create();
        }



        // On instancie le formulaire
        $form = new FormBuilder;

        // On ajoute chacune des parties qui nous intéressent
        $form->debutForm()
            ->ajoutLabelFor('pseudo', 'Pseudo')
            ->ajoutInput('text', 'pseudo', ['id' => 'pseudo', 'class' => 'form-control'])
            ->ajoutLabelFor('email', 'Email')
            ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control'])
            ->ajoutLabelFor('password', 'Mot de passe')
            ->ajoutInput('password', 'password', ['id' => 'password', 'class' => 'form-control mb-3'])
            
            ->ajoutBouton('M\'inscrire', ['class' => 'btn badge badge-primary'])
            ->finForm();

        // On envoie le formulaire à la vue en utilisant notre méthode "create"
        $this->render('user/formUser', ['newUserForm' => $form->create()]);
    }

    public function newComment()
    {

        $currentUser = new UserModel;
        $currentUser->setPseudo($_SESSION['pseudo']);
        $currentUser->setLogin($_SESSION['login']);
        $currentUser->setPseudo($_SESSION['pseudo']);
        
         // On instancie le formulaire
         $form = new FormBuilder;

         // On ajoute chacune des parties qui nous intéressent
         $form->debutForm()
             ->ajoutLabelFor('pseudo', 'Pseudo')
             ->ajoutInput('text', 'pseudo', ['id' => 'pseudo', 'value' => $currentUser->getPseudo(), 'class' => 'form-control'])
             ->ajoutLabelFor('email', 'Email')
             ->ajoutInput('email', 'email', ['id' => 'email', 'value' => $currentUser->getLogin(), 'class' => 'form-control'])
             ->ajoutLabelFor('contenu', 'Message :')
             ->ajoutTextarea('contenu','' , ['id' => 'contenu', 'class' => 'form-control'])
             
             ->ajoutBouton('Envoyer', ['class' => 'btn btn-primary btn-sm'])
             ->finForm();
 
         // On envoie le formulaire à la vue en utilisant notre méthode "create"
         $this->render('user/formUser', ['newUserForm' => $form->create()]);
    }

    public function monprofil()
    {

        $user = new UserModel;
        $profil = $user->findByLogin($_SESSION['login']);

         // On instancie le formulaire
         $form = new FormBuilder;

         // On ajoute chacune des parties qui nous intéressent
         $form->debutForm()
             ->ajoutLabelFor('pseudo', 'Pseudo')
             ->ajoutInput('text', 'pseudo', ['id' => 'pseudo', 'value' => $profil->pseudo, 'class' => 'form-control', 'readonly' => 'readonly'])
             ->ajoutLabelFor('email', 'Email')
             ->ajoutInput('email', 'email', ['id' => 'email', 'value' => $profil->login, 'class' => 'form-control', 'readonly' => 'readonly'])
             ->ajoutLabelFor('roles', 'Type membre')
             ->ajoutInput('text', 'roles', ['id' => 'roles', 'value' => $profil->roles, 'class' => 'form-control', 'readonly' => 'readonly'])
             ->finForm();

        $this->render('user/userProfil', ['profil' => $form->create()]);
    }
}
