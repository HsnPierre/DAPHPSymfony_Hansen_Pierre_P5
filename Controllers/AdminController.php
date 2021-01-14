<?php
namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\PostModel;
use App\Models\UserModel;

class AdminController extends Controller
{
    public function index()
    {
        $admin = new AdminController;

        if(isset($_POST['edit']) || isset($_SESSION['edit'])){
            $admin->updatePost();
        } else
        if(isset($_POST['delete'])){
            $admin->deletePost();
        } else
        if(isset($_POST['add']) || isset($_SESSION['add'])){
            $admin->addPost();
        } else {
            $admin->showPost();
        }
        
        $donnees = array ("title" => 'Dashboard');

        $this->render('admin/index', $donnees, 'dashboard');
    }

    public function showPost()
    {
        $post = new PostModel;
        $user = new UserModel;
        $valeurs = $post->findAll();
        $_SESSION['content'] = [];

        
        foreach($valeurs as $valeur){

            $nom = $user->findOneById('name', $valeur['idUser']);
            $prenom = $user->findOneById('surname', $valeur['idUser']);
            $date = date('\P\o\s\t\é \l\e d.m.y, \à H:i', strtotime($valeur['date']));
            $id = $valeur['idPost'];

            if(isset($valeur['editor']) && isset($valeur['dateEdit'])){
                $dateEdit = date('\M\i\s \à \j\o\u\r \l\e d.m.y, \à H:i', strtotime($valeur['dateEdit']));
                $_SESSION['content'][] =
                "
                <div id='post".$id."'>
                <p>".$date." (".$dateEdit.")</p>
                <h3 class='post-title text-center'>".$valeur['title']."</h3>
                <h5 class='post-subtitle'>".$valeur['description']."</h5>
                <p>".$valeur['content']."</p>
                <p>".$prenom['surname']." ".$nom['name']." (édité par ".$valeur['editor'].")</p>
                    <div class=''>
                        <form action=' ' method='post' id='delete' class='text-center'>
                            <div class='form-check col'>
                                <input class='form-check-input' type='checkbox' id='delete' required>
                                <label class='form-check-label' for='delete'>Cocher cette case pour supprimer l'article</label>
                            </div>
                            <button class='btn btn-danger col-3' name='delete' value='$id'>Supprimer</button>
                        </form>
                    </div><br>
                    <form action=' ' method='post' id='edit' class='text-center'>
                        <button class='btn btn-primary col-3' name='edit' value='$id'>Editer</button>
                    </form>
                </div>
                <hr>
                "
                ;
            } else {

                $_SESSION['content'][] =
                "
                <div id='post".$id."'>
                <p>".$date."</p>
                <h3 class='post-title text-center'>".$valeur['title']."</h3>
                <h5 class='post-subtitle'>".$valeur['description']."</h5>
                <p>".$valeur['content']."</p>
                <p>".$prenom['surname']." ".$nom['name']."</p>
                    <div class=''>
                        <form action=' ' method='post' id='delete' class='text-center'>
                            <div class='form-check col'>
                                <input class='form-check-input' type='checkbox' id='delete' required>
                                <label class='form-check-label' for='delete'>Cocher cette case pour supprimer l'article</label>
                            </div>
                            <button class='btn btn-danger col-3' name='delete' value='$id'>Supprimer</button>
                        </form>
                    </div><br>
                    <form action=' ' method='post' id='edit' class='text-center'>
                        <button class='btn btn-primary col-3' name='edit' value='$id'>Editer</button>
                    </form>
                </div>
                <hr>
                "
                ;
            }
        }

    }

    public function addPost()
    {
        $post = new PostModel;
        $admin = new AdminController;
        $_SESSION['add'] = '';

        if(isset($_POST['addPost']) && $admin->validate($_POST, ['titre', 'chapo', 'contenu'])){
            $id = $_SESSION['user']['idUser'];
            $titre = strip_tags($_POST['titre']);
            $chapo = strip_tags($_POST['chapo']);
            $contenu = strip_tags($_POST['contenu']);

            if($admin->alreadyUse($titre, 'title') && $admin->alreadyUse($chapo, 'description') && $admin->alreadyUse($contenu, 'content')){
                $post->setTitle($titre);
                $post->setDescription($chapo);
                $post->setContent($contenu); 
                $post->setIdUser($id);

                $post->create();

                $_SESSION['valide'] = "L'annonce a bien été ajoutée.";
                unset($_SESSION['add']);
                header('Location: /admin');
                exit;
            }
        }

        if(isset($_POST['back'])){
            unset($_SESSION['add']);
        }
    }

    public function deletePost()
    {
        $post = new PostModel;
        $id = $_POST['delete'];

        $post->delete($id);
        $_SESSION['valide'] = "Le post a bien été supprimé.";
        header('Location: /admin');

    }

    public function updatePost()
    {
        $post = new PostModel;
        $admin = new AdminController;
        
        if(isset($_POST['edit'])){
            $_SESSION['post']['idPost'] = $_POST['edit'];
        }
        $id = $_SESSION['post']['idPost'];

        $_SESSION['edit'] = '';

        $tab = $post->find($id);
        $_SESSION['titre'] = $tab['title'];
        $_SESSION['chapo'] = $tab['description'];
        $_SESSION['contenu'] = $tab['content'];

        if(isset($_POST['back'])){
            unset($_SESSION['edit']);
            header('Location: /admin');   
        }

        if(isset($_POST['updatePost']) && $admin->validate($_POST, ['titre', 'chapo', 'contenu'])){
            $titre = strip_tags($_POST['titre']);
            $chapo = strip_tags($_POST['chapo']);
            $contenu = strip_tags($_POST['contenu']);

            if($admin->alreadyUseBis($titre, 'title', $tab) && $admin->alreadyUseBis($chapo, 'description', $tab) && $admin->alreadyUseBis($contenu, 'content', $tab)){
                $i = 0;
                $date = date("Y-m-d H:i:s");

                if($titre != $tab['title']){
                    $post->setTitle($titre);
                    $i++;
                }
                if($chapo != $tab['description']){
                    $post->setDescription($chapo);
                    $i++;
                }
                if($contenu != $tab['content']){
                    $post->setContent($contenu);
                    $i++;
                }
                if($i > 0){
                    $prenom = $_SESSION['user']['surname'];
                    $nom = $_SESSION['user']['name'];
                    $editeur = $prenom.' '.$nom;

                    $post->setDateEdit($date);
                    $post->setEditor($editeur);
                    $post->update();

                    $_SESSION['valide'] = 'Les modifications ont bien été prises en compte.';
                    header('Location: /admin');
                    unset($_SESSION['edit']);
                    exit;
                } else {
                    $_SESSION['valide'] = "Aucune modification n'a été effectué.";
                    unset($_SESSION['edit']);
                }
            }

        }
    }

    public function validateComment()
    {

    }

    public function setAdmin()
    {

    }

    public function validate(array $donnees, array $champs)
    {
        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ])){
                if($champ == 'mdp'){
                    $_SESSION['erreur'] = 'Le champ mot de passe ne peut pas être vide';
                    return false;
                }
                $_SESSION['erreur'] = "Le champ ".$champ." ne peut pas être vide.";
                return false;
            }
        }
        return true;
    }

    public function alreadyUse(string $donnee, string $type)
    {
        $post = new PostModel;
        $tab = $post->findAllBy($type);
        for($i = 0; $i < count($tab); $i++){

            if ($donnee == $tab[$i]["$type"]){
                if($type == 'title'){
                    $_SESSION['erreur'] = "Il existe déjà un article avec ce titre.";
                    return false;
                }
                if($type == 'content'){
                    $_SESSION['erreur'] = "Il existe déjà un article identique.";
                    return false;
                }
                if($type == 'description'){
                    $_SESSION['erreur'] = "Il existe déjà un article avec ce chapo.";
                    return false;
                }
                $_SESSION['erreur'] = "Il y a une erreur avec ".$type;
                return false;
            }
        }
        return true;
    }

    public function alreadyUseBis(string $donnee, string $type, array $donnees)
    {
        $post = new PostModel;
        $tab = $post->findAllBy($type);
        for($i = 0; $i < count($tab); $i++){

            if ($donnee == $tab[$i]["$type"] && $tab[$i]["$type"] != $donnees["$type"]){
                if($type == 'title'){
                    $_SESSION['erreur'] = "Il existe déjà un article avec ce titre.";
                    return false;
                }
                if($type == 'content'){
                    $_SESSION['erreur'] = "Il existe déjà un article identique.";
                    return false;
                }
                if($type == 'description'){
                    $_SESSION['erreur'] = "Il existe déjà un article avec ce chapo.";
                    return false;
                }
                $_SESSION['erreur'] = "Il y a une erreur avec ".$type;
                return false;
            }
        }
        return true;
    }
}
