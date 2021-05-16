<?php


namespace App\Src\Controllers;

use Exception;
use App\Src\Core\FormBuilder;
use App\Src\Models\CommentModel;
use App\Src\Models\PhotoModel;
use App\Src\Models\UserModel;

/**
 * PhotoController pour le traitement des photos et commentaies
 *
 * @author Boubacar
 */
class PhotoController extends Controller
{

    public function index()
    {

        $model = new PhotoModel();
        $photos = $model->listPhotos();
        //var_dump($photos);
        $this->render('photo/viewPhoto', ['photos' => $photos]);
    }


    public function mesPhotos()
    {
        if (!isset($_SESSION['login'])) {
            header('Location: index.php?entite=user&action=connexion');
        }

        $user = new UserModel;
        $currentUser = $user->findByLogin($_SESSION['login']);
        $idUser = $currentUser->id;

        $photo = new PhotoModel;

        $photos = $photo->findPhotosByUser($idUser);
        $this->render('photo/viewPhoto', ['photos' => $photos]);
    }



    public function voir($id)
    {

        if (isset($_POST) && !empty($_POST['contenu'])) {
            $contenu = filter_input(INPUT_POST, 'contenu', FILTER_SANITIZE_SPECIAL_CHARS);

            $idUser = $_SESSION['id'];

            $newComment = new CommentModel;

            $newComment->setContenu($contenu);
            $newComment->setidPhoto($id);
            $newComment->setUser($idUser);
            $newComment->setVisible(1);
            $newComment->create();
        }

        //On récupère la photo
        $modelPhoto = new PhotoModel();
        $photo = $modelPhoto->find($id);

        //et ses commentaires
        $modelComment = new CommentModel;
        $comments = $modelComment->findByPhotoId($photo->id);
        //$tab = get_object_vars($photo);

        $this->render('photo/voirPhoto', [
            'photo' => $photo,
            'comments' => $comments
        ]);
    }



    public function newPhoto()
    {

        if (FormBuilder::validate($_POST, ['titre']) && isset($_FILES['photo']) && $_FILES['photo']['size'] <= 5000000) {

            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['photo']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            if (in_array($extension_upload, $extensions_autorisees)) {
                $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_SPECIAL_CHARS);

                try {
                    $namePhoto = 'photos/' . basename($_FILES['photo']['name']);
                    $user = new UserModel;
                    $currentUser = $user->findByLogin($_SESSION['login']);
                    $idUser = $currentUser->id;

                    $newPhoto = new PhotoModel;
                    $newPhoto->setTitlePhoto($titre);
                    $newPhoto->setNameFile($namePhoto);
                    $newPhoto->setidUser($idUser);

                    $newPhoto->create();
                    // On peut valider le fichier et le stocker définitivement
                    move_uploaded_file($_FILES['photo']['tmp_name'], $namePhoto);
                } catch (Exception $e) {
                    $e->getMessage();
                }
            }
        }

        $formPhoto = new FormBuilder;

        // On ajoute chacune des parties qui nous intéressent
        $formPhoto->debutForm('post', '#', ['enctype' => 'multipart/form-data'])
            ->ajoutLabelFor('titre', 'Titre')
            ->ajoutInput('text', 'titre', ['id' => 'tire', 'class' => 'form-control'])
            ->ajoutLabelFor('photo', '')
            ->ajoutInput('file', 'photo', ['id' => 'photo', 'accept' => '.png, .jpg, .jpeg', 'class' => 'form-control mb-3'])
            ->ajoutBouton('Ajouter', ['class' => 'btn badge badge-primary'])
            ->finForm();

        // On envoie le formulaire à la vue en utilisant notre méthode "create"
        $this->render('photo/formPhoto', ['newPhotoForm' => $formPhoto->create()]);
    }

    public function newComment()
    {
        $formPhoto = new FormBuilder;

        // On ajoute chacune des parties qui nous intéressent
        $formPhoto->debutForm()
            ->ajoutLabelFor('pseudo', 'Pseudo')
            ->ajoutInput('text', 'titre', ['id' => 'tire', 'class' => 'form-control'])
            ->ajoutLabelFor('photo', '')
            ->ajoutInput('file', 'photo', ['id' => 'photo', 'accept' => '.png, .jpg, .jpeg', 'class' => 'form-control mb-3'])
            ->ajoutBouton('Ajouter', ['class' => 'btn badge badge-primary'])
            ->finForm();

        // On envoie le formulaire à la vue en utilisant notre méthode "create"
        $this->render('photo/formPhoto', ['newPhotoForm' => $formPhoto->create()]);
    }

    public function delatePhoto()
    {
        if (!empty($_GET['id'])) {
            $idPhoto = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            //on vérifie si la photo existe dans la base de données
            //et si c'est une photo de l'utilisateur connecté
            $model = new PhotoModel;
            $photo = $model->find($idPhoto);
            //var_dump($photo);
            if (!empty($photo) && $photo->id_user == $_SESSION['id']) {

                //On doit supprimer d'abord tous les commentaires de cette photo
                try {
                    $model->delete($idPhoto);
                } catch (Exception $e) {
                    $erreur = ('Vous ne pouvez pas supprimer cette photo !');
                }
            }
            
            header('Location: index.php?entite=user');
        }
    }


    public function delateComment()
    {
        if (!empty($_GET['id'])) {
            $idComment = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            //on vérifie si le commentaire existe dans la base de données
            //et si c'est un commentaire de l'utilisateur connecté
            $model = new CommentModel;
            $comment = $model->find($idComment);
            //var_dump($comment);
            //die();
            if (!empty($comment) && $comment->id_user === $_SESSION['id']) {

                try {
                    $model->delete($idComment);
                } catch (Exception $e) {
                    $erreur = ('Impossible de supprimer ce commentaire !');
                }
            }
            
            header('Location: index.php?entite=photo&action=voir&id='.$comment->id_photo);
        }
    }
}
