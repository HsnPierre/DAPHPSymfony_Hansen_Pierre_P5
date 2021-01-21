<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    public function index()
    {
        $donnees = array ("title" => 'Erreur', "subtitle" => "La page demandée n'existe pas.");
        $this->render('error/index', $donnees, 'auth');
    }

}