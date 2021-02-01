<?php
namespace App\Controllers;

use App\Models\UserModel;

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

        if(!empty($_POST)){
            if($login->validate($_POST, ['pseudo', 'mdp'])){

                $userModel = new UserModel;

                $userArray = $userModel->findOneBy('username', $_POST['pseudo']);

                if(!$userArray){
                Session::put3d('erreur', 0, "Le pseudonyme et/ou le mot de passe est incorrect");
                header('Location: /login');
                }

                $user = $userModel->hydrate($userArray);

                if(password_verify($_POST['mdp'], $user->getPassword())){
                    $user->setSession();
                    header('Location: '. $_SERVER['HTTP_REFERER']);
                    exit;
                }else{
                    Session::put3d('erreur', 0, "Le pseudonyme et/ou le mot de passe est incorrect");
                    header('Location: /login');
                }

            } else {
                header('Location: /login');
            }
        }
    }

    public function validate(array $donnees, array $champs)
    {
        Session::put('erreur', []);
        $i = 0;

        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ])){
                if($champ == 'pseudo'){
                    Session::put3d('erreur', $i, "Le champ pseudonyme ne peut pas être vide");
                    $i++;
                }
                if($champ == 'mdp'){
                    Session::put3d('erreur', $i, "Le champ mot de passe ne peut pas être vide");
                    $i++;
                }
            }
        }
        if($i > 0){
            return false;
        }
        return true;
    }
}
