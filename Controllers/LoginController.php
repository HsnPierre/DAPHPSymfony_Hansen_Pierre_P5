<?php
namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends Controller
{
    public function index()
    {
        $error = $_SESSION['erreur'];
        $valide = $_SESSION['valide'];

        $login = new LoginController;

        if(!empty($_POST) && $login->validate($_POST, ['pseudo', 'mdp'])){

            $userModel = new UserModel;

            $userArray = $userModel->findOneBy('username', $_POST['pseudo']);

            if(!$userArray){
               $_SESSION['erreur'] = "Le pseudonyme et/ou le mot de passe est incorrect";
            }

            $user = $userModel->hydrate($userArray);

            if(password_verify($_POST['mdp'], $user->getPassword())){
                $user->setSession();
                header('Location: /main');
                exit;
            }else{
                $_SESSION['erreur'] = "Le pseudonyme et/ou le mot de passe est incorrect";
            }

        }

        $error = $_SESSION['erreur'];
        $valide = $_SESSION['valide'];

        $donnees = array ("error" => $error, "valide" => $valide);

        $this->render('login/index', $donnees, 'auth');
    }

    public function validate(array $donnees, array $champs)
    {
        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ])){
                if($champ == 'mdp'){
                    $_SESSION['erreur'] = 'Le champ mot de passe ne peut pas être vide';
                    return false;
                }
                $_SESSION['erreur'] = "Le champ ".$champ." ne peut pas être vide.";
                return false;
            }
        }
        return true;
    }
}
