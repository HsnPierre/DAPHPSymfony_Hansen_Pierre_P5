<?php
namespace App\Controllers;

class AuthController extends Controller
{
    public function index()
    {
        $this->render('auth/index', [], 'auth');
    }
}