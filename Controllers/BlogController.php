<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PostModel;
use App\Models\CommentModel;

class BlogController extends Controller
{
    public function index()
    {
        $login = new LoginController;
        $blog = new BlogController;

        if(isset($_POST['pseudo'])){
            $login->login();
        }
        
        $tmp = $blog->showPost('date', 'DESC');
        extract($tmp);

        $donnees = array ("title" => "Blog", "subtitle" => "Mes différentes actualités", "image" => "https://zupimages.net/up/21/03/t0tn.jpg", "valeurs" => $valeurs, "user" => $user);

        $this->render('blog/index', $donnees);
        
    }

    public function post($id)
    {
        $main = new MainController;
        $blog = new BlogController;
        $comment = new CommentController;
        $post = new PostModel;
        $user = new UserModel;
        $idPost = (int) $id[0];

        if(isset($_POST['pseudo'])){
            $main->login();
        }

        $infopost = $post->find($idPost);
        $infouser = $user->find($infopost['idUser']);
        $date = date('d.m.y, \à H:i', strtotime($infopost['date']));

        if($infopost['editor'] != null && $infopost['dateEdit'] != null){
            $dateEdit = date('\M\i\s \à \j\o\u\r \l\e d.m.y, \à H:i', strtotime($infopost['dateEdit']));
            $auteur = $infouser['surname'].' '.$infouser['name'].' (modifié par '.$infopost['editor'].')';
            $date = $date.' ('.$dateEdit.')';
        } else {
            $auteur = $infouser['surname'].' '.$infouser['name'];
        }
        $_SESSION['postTitle'] = $infopost['title'];
        $_SESSION['postDesc'] = $infopost['description'];
        $_SESSION['postContent'] = $infopost['content'];
        $_SESSION['postAuteur'] = $auteur;
        $_SESSION['postDate'] = $date;

        $comment->showComment($idPost);
        if(isset($_POST['submit']) && !isset($_POST['cancel'])){
            $comment->addComment($idPost);
        }

        $this->render('blog/post', [], 'post');
    }

    public function showPost(string $type, string $order)
    {
        $post = new PostModel;
        $user = new UserModel;

        $valeurs = $post->findOrderBy($type, $order);

        $result = array ("valeurs" => $valeurs, "user" => $user);

        return $result;
    }
}
