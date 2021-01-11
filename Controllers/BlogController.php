<?php
namespace App\Controllers;

class BlogController extends Controller
{
    public function index()
    {
        $donnees = array ("title" => "Blog", "subtitle" => "Ceci est mon blog", "image" => "img/blog-bg.jpg");

        $this->render('blog/index', $donnees);
    }
}
