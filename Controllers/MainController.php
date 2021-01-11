<?php

namespace App\Controllers;

class MainController extends Controller
{
    public function index()
    {
        $donnees = array ("title" => "Welcome !", "subtitle" => "Lorem ipsum dolor sit amet", "image" => "img/home-bg.jpg");

        $this->render('main/index', $donnees);
    }
}