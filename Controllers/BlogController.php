<?php
namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\UserModel;
use App\Models\PostModel;

class BlogController extends Controller
{
    public function index()
    {
        $main = new MainController;
        $blog = new BlogController;

        if(isset($_POST['pseudo'])){
            $main->login();
        }

        $blog->showPost();

        $donnees = array ("title" => "Blog", "subtitle" => "Ceci est mon blog", "image" => "img/blog-bg.jpg");

        $this->render('blog/index', $donnees);
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
                <p class='text-center'>".$date." (".$dateEdit.")</p>
                <div class='text-center'><a href=''><img src='https://www.heberger-image.fr/images/2021/01/14/post53a53974587df487.jpg' alt='Post Image' border='0' /></a></div>
                <h3 class='post-title text-center'><a href=''>".$valeur['title']."</a></h3>
                <h5 class='post-subtitle text-center'>".$valeur['description']."</h5>
                <p class='text-center'>".$prenom['surname']." ".$nom['name']." (édité par ".$valeur['editor'].")</p>
                <hr>
                "
                ;
            } else {

                $_SESSION['content'][] =
                "
                <div id='post".$id."'>
                <p class='text-center'>".$date."</p>
                <div class='text-center'><a href=''><img src='https://www.heberger-image.fr/images/2021/01/14/post53a53974587df487.jpg' alt='Post Image' border='0' /></a></div>
                <h3 class='post-title text-center'><a href=''>".$valeur['title']."</a></h3>
                <h5 class='post-subtitle text-center'>".$valeur['description']."</h5>
                <p class='text-center'>".$prenom['surname']." ".$nom['name']."</p>
                <hr>
                "
                ;
            }
        }

    }
}
