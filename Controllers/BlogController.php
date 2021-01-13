<?php
namespace App\Controllers;

use App\Controllers\MainController;

class BlogController extends Controller
{
    public function index()
    {
        $main = new MainController;

        if(isset($_POST['pseudo'])){
            $main->login();
        }

        $donnees = array ("title" => "Blog", "subtitle" => "Ceci est mon blog", "image" => "img/blog-bg.jpg");

        $this->render('blog/index', $donnees);
    }
}
