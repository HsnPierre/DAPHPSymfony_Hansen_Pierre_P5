<?php
namespace App\Controllers;

use App\Models\PostModel;
use App\Models\UserModel;
use App\Models\CommentModel;
use App\Core\Session;

class AdminController extends Controller
{
    public function index()
    {

        $role = json_decode(Session::get3d('user', 'role'));

        if(!in_array('Administrateur', $role) && Session::get('user') != null){
            $donnees = array ("title" => 'Erreur', "subtitle" => "Vous ne pouvez pas accéder à la page demandée.");
            $this->render('error/index', $donnees, 'auth');
            exit;
        }

        $admin = new AdminController;
        $blog = new BlogController;
        $user = new UserModel;

        if(isset($_POST['edit']) || Session::get('edit') !== null){
            $admin->updatePost();
        } elseif(isset($_POST['delete'])){
            $admin->deletePost();
        } elseif(isset($_POST['add']) || Session::get('add') !== null){
            $admin->addPost();
        }   

        if(isset($_POST['title'])){
            $tmp = $blog->showPost('title', $_POST['title']);
        } elseif(isset($_POST['date'])){
            $tmp = $blog->showPost('date', $_POST['date']);
        } elseif(isset($_POST['auteur'])){
            $tmp = $blog->showPost('idUser', $_POST['auteur']);
        } else {
            $tmp = $blog->showPost('date', 'ASC');
        }

        extract($tmp);

        $donnees = array ("title" => 'Dashboard', "valeurs" => $valeurs, "user" => $user);

        $this->render('admin/index', $donnees, 'dashboard');
    }

    public function posts()
    {
        $role = json_decode(Session::get3d('user', 'role'));

        if(!in_array('Administrateur', $role) && Session::get('user') != null){
            $donnees = array ("title" => 'Erreur', "subtitle" => "Vous ne pouvez pas accéder à la page demandée.");
            $this->render('error/index', $donnees, 'auth');
            exit;
        }

        $admin = new AdminController;
        $blog = new BlogController;

        if(isset($_POST['edit']) || Session::get('edit') !== null){
            $admin->updatePost();
        } elseif(isset($_POST['delete'])){
            $admin->deletePost();
        } elseif(isset($_POST['add']) || Session::get('add') !== null){
            $admin->addPost();
        } 
        
        if(isset($_POST['title'])){
            $tmp = $blog->showPost('title', $_POST['title']);
        } elseif(isset($_POST['date'])){
            $tmp = $blog->showPost('date', $_POST['date']);
        } elseif(isset($_POST['auteur'])){
            $tmp = $blog->showPost('idUser', $_POST['auteur']);
        } else {
            $tmp = $blog->showPost('date', 'ASC');
        }

        extract($tmp);

        $donnees = array ("title" => 'Dashboard', "valeurs" => $valeurs, "user" => $user);

        $this->render('admin/index', $donnees, 'dashboard');
    }

    public function comments()
    {
        $role = json_decode(Session::get3d('user', 'role'));

        if(!in_array('Administrateur', $role) && Session::get('user') != null){
            $donnees = array ("title" => 'Erreur', "subtitle" => "Vous ne pouvez pas accéder à la page demandée.");
            $this->render('error/index', $donnees, 'auth');
            exit;
        }

        $comment = new CommentController;

        if(isset($_POST['novalid'])){
            Session::forget('tmp');
        }

        if(isset($_POST['valid']) || Session::get('tmp') !== null){
            Session::put('tmp', '');
            $tmp = $comment->showComment(1);
        } else {
            $tmp = $comment->showComment(0);
        }

        if(isset($_POST['oui']) || isset($_POST['non'])){
            $comment->validateComment();
        }

        extract($tmp);

        $donnees = array ("title" => 'Dashboard', "valeurs" => $valeurs, "user" => $user);

        $this->render('admin/comments', $donnees, 'dashboard');

    }

    public function users()
    {
        $role = json_decode(Session::get3d('user', 'role'));

        if(!in_array('Host', $role) && Session::get('user') != null){
            $donnees = array ("title" => 'Erreur', "subtitle" => "Vous ne pouvez pas accéder à la page demandée.");
            $this->render('error/index', $donnees, 'auth');
            exit;
        }

        $admin = new AdminController;

        if(isset($_POST['search'])){
            $admin->showThisUser($_POST['username']);
        } elseif(isset($_POST['username'])){
            $admin->showUsers('username', $_POST['username']);
        } elseif(isset($_POST['date'])){
            $admin->showUsers('date', $_POST['date']);
        } elseif(isset($_POST['role'])){
            $admin->showUsers('role', $_POST['role']);
        } else {
            $admin->showUsers('username', 'ASC');
        }

        if(isset($_POST['setadmin'])){
            $admin->setAdmin($_POST['setadmin']);
        } elseif(isset($_POST['unsetadmin'])){
            $admin->unsetAdmin($_POST['unsetadmin']);
        }
    }

    public function addPost()
    {
        $post = new PostModel;
        $admin = new AdminController;
        Session::put('add', '');

        if(isset($_POST['addPost']) && $admin->validate($_POST, ['titre', 'chapo', 'contenu'])){
            $id = Session::get3d('user', 'idUser'); 
            $titre = strip_tags($_POST['titre']);
            $chapo = strip_tags($_POST['chapo']);
            $contenu = htmlentities($_POST['contenu'], ENT_HTML5);

            if($admin->alreadyUse($titre, 'title') && $admin->alreadyUse($chapo, 'description') && $admin->alreadyUse($contenu, 'content')){
                $post->setTitle($titre);
                $post->setDescription($chapo);
                $post->setContent($contenu); 
                $post->setIdUser($id);

                $post->create();

                Session::put('valide', "L'annonce a bien été ajoutée");
                Session::forget('add');
                header('Location: /admin');
                exit;
            }
        }

        if(isset($_POST['back'])){
            Session::forget('add');
        }
    }

    public function deletePost()
    {
        $post = new PostModel;
        $id = $_POST['delete'];

        $post->delete($id);
        Session::put('valide', "Le post a bien été supprimé");
        header('Location: /admin');

    }

    public function updatePost()
    {
        $post = new PostModel;
        $admin = new AdminController;
        
        if(isset($_POST['edit'])){
            Session::put('idPost', $_POST['edit']);
        }
        $id = Session::get('idPost');

        Session::put('edit', '');

        $tab = $post->find($id);
        Session::put('titre', $tab['title']);
        Session::put('chapo', $tab['description']);
        Session::put('contenu', $tab['content']);

        if(isset($_POST['back'])){
            Session::forget('edit');
            header('Location: /admin');   
        }

        if(isset($_POST['updatePost']) && $admin->validate($_POST, ['titre', 'chapo', 'contenu'])){
            $titre = strip_tags($_POST['titre']);
            $chapo = strip_tags($_POST['chapo']);
            $contenu = htmlentities($_POST['contenu'], ENT_HTML5);

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
                    $prenom = Session::get3d('user', 'surname');
                    $nom = Session::get3d('user', 'name');
                    $editeur = $prenom.' '.$nom;

                    $post->setDateEdit($date);
                    $post->setEditor($editeur);
                    $post->update();

                    Session::put('valide', "Les modifications ont bien été prises en compte.");
                    header('Location: /admin');
                    header('Refresh:5');
                    Session::forget('edit');
                    exit;
                } else {
                    Session::put('valide', "Aucune modification n'a été effectué.");
                    Session::forget('edit');
                }
            }

        }
    }

    public function setAdmin($id)
    {
        $user = new UserModel;
        Session::put('idUser', $id);
        $user->setRole(json_encode(['Administrateur','Utilisateur']));
        $user->update();
        header('Location: /admin/users');
    }

    public function unsetAdmin($id)
    {
        $user = new UserModel;
        Session::put('idUser', $id);
        $user->setRole(json_encode(['Utilisateur']));
        $user->update();
        header('Location: /admin/users');
    }

    public function showUsers(string $type, string $order)
    {
        $user = new UserModel;

        $valeurs = $user->findOrderBy($type, $order);

        $donnees = array ("title" => 'Dashboard', "valeurs" => $valeurs);

        $this->render('admin/users', $donnees, 'dashboard');

    }

    public function showThisUser(string $username)
    {
        $user = new UserModel;
        $tableau = array ("username" => $username);

        $valeurs = $user->findBy($tableau);

        $donnees = array ("title" => 'Dashboard', "valeurs" => $valeurs);

        $this->render('admin/users', $donnees, 'dashboard');

    }

    public function validate(array $donnees, array $champs)
    {
        $i = 0;
        Session::put('erreur', []);

        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ])){
                if($champ == 'mdp'){
                    Session::put3d('erreur', $i, "Le champ mot de passe ne peut pas être vide");
                    $i++;
                }
                Session::put3d('erreur', $i, "Le champ ".$champ." ne peut pas être vide.");
                $i++;
            }
        }
        if($i > 0){
            return false;
        }
        return true;
    }

    public function alreadyUse(string $donnee, string $type)
    {
        $post = new PostModel;
        $tab = $post->findAllBy($type);
        $j = 0;
        Session::put('erreur', []);
        for($i = 0; $i < count($tab); $i++){

            if ($donnee == $tab[$i]["$type"]){
                if($type == 'title'){
                    Session::put3d('erreur', $j, "Il existe déjà un article avec ce titre.");
                    $j++;
                }
                if($type == 'content'){
                    Session::put3d('erreur', $j, "Il existe déjà un article identique.");
                    $j++;
                }
                if($type == 'description'){
                    Session::put3d('erreur', $j, "Il existe déjà un article avec ce chapo.");
                    $j++;
                }
            }
        }
        if($j > 0){
            return false;
        }
        return true;
    }

    public function alreadyUseBis(string $donnee, string $type, array $donnees)
    {
        $post = new PostModel;
        $tab = $post->findAllBy($type);
        $j = 0;
        Session::put('erreur', []);
        for($i = 0; $i < count($tab); $i++){

            if ($donnee == $tab[$i]["$type"] && $tab[$i]["$type"] != $donnees["$type"]){
                if($type == 'title'){
                    Session::put3d('erreur', $j, "Il existe déjà un article avec ce titre.");
                    $j++;
                }
                if($type == 'content'){
                    Session::put3d('erreur', $j, "Il existe déjà un article identique.");
                    $j++;
                }
                if($type == 'description'){
                    Session::put3d('erreur', $j, "Il existe déjà un article avec ce chapo.");
                    $j++;
                }
            }
        }
        if($j > 0){
            return false;
        }
        return true;
    }
}
