<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Core\Session;
use App\Core\Post;

class LoginController extends Controller
{
    public function index()
    {
        $login = new LoginController;

        $login->login();
        if(Session::get3d('user', 'idUser') !== null){
            header('Location: /main');
        }

        $donnees = array ("title" => 'Connexion');

        $this->render('login/index', $donnees, 'auth');
    }

    public function login()
    {
        $login = new LoginController;
        Session::put('erreur', []);
        $i = 0;

        if(!empty(Post::raw())){
            if($login->validate(Post::raw(), ['pseudo', 'mdp'])){

                $userModel = new UserModel;

                $userArray = $userModel->findOneBy('username', Post::get('pseudo'));

                if(!$userArray){
                    Session::put3d('erreur', $i, "Le pseudonyme et/ou le mot de passe est incorrect");
                }

                $user = $userModel->hydrate($userArray);

                if(password_verify(Post::get('mdp'), $user->getPassword())){
                    $user->setSession();
                    header('Location: '. filter_input(INPUT_SERVER, 'HTTP_REFERER'));
                    exit;
                }else{
                    Session::put3d('erreur', $i, "Le pseudonyme et/ou le mot de passe est incorrect");
                }

            }
        }
    }

    public function validate(array $donnees, array $champs)
    {
        Session::put('erreur', []);
        $compteur = 0;
        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ])){
                if($champ == 'pseudo'){
                    Session::put3d('erreur', $compteur, "Le champ pseudonyme ne peut pas être vide");
                    $compteur++;
                }
                if($champ == 'mdp'){
                    Session::put3d('erreur', $compteur, "Le champ mot de passe ne peut pas être vide");
                    $compteur++;
                }
            }
        }
        if($compteur > 0){
            return false;
        }
        return true;
    }
}
