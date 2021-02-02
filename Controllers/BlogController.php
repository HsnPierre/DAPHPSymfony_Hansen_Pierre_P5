<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PostModel;
use App\Models\CommentModel;
use App\Core\Session;
use App\Core\Post;

class BlogController extends Controller
{
    public function index()
    {
        $login = new LoginController;
        $blog = new BlogController;

        if(Post::get('pseudo') !== null){
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
        $comment = new CommentController;
        $post = new PostModel;
        $user = new UserModel;
        $idPost = (int) $id[0];

        if(Post::get('pseudo') !== null){
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
        Session::put('postTitle', $infopost['title']);
        Session::put('postDesc', $infopost['description']);
        Session::put('postContent', $infopost['content']);
        Session::put('postAuteur', $auteur);
        Session::put('postDate', $date);

        $comment->showThisPostComment($idPost);
        if(Post::get('submit') !== null && Post::get('cancel') === null){
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
