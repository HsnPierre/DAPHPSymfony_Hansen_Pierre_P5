<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\MainController;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = new ProfileController;

        $roles = preg_split("[\"]", $_SESSION['user']['role']);
        $role = $roles[1];

        if(isset($_POST['update']) || isset($_SESSION['update'])){
            $profile->update();
        }

        if(isset($_POST['delete'])){
            $profile->delete();
        }

        $donnees = array ("role" => $role, "title" => 'Mon profil');

        $this->render('profile/index', $donnees, 'auth');
    }

    public function update()
    {
        $profile = new ProfileController;
        $_SESSION['update'] = '';


        if(isset($_POST['modif']) && $profile->validate($_POST, ['nom', 'prenom', 'pseudo', 'mail']) && $profile->validateMail($_POST['mail'])){
            
            if($profile->alreadyUse($_POST['pseudo'], 'username') && $profile->alreadyUse($_POST['mail'], 'email')){
                $i = 0;
                $user = new UserModel;
                $pseudo = $_POST['pseudo'];
                $mail = strip_tags($_POST['mail']);
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $date = date("d.m.y G:i:s T");

                if($pseudo != $_SESSION['user']['username']){
                    $user->setUsername($pseudo);
                    $i++;
                }
                if($mail != $_SESSION['user']['email']){
                    $user->setEmail($mail);
                    $i++;
                }
                if($nom != $_SESSION['user']['name']){
                    $user->setName($nom);
                    $i++;
                }
                if($prenom != $_SESSION['user']['surname']){
                    $user->setSurname($prenom);
                    $i++;
                }
                if($i > 0){
                    $user->update();
                    
                    $main = new MainController;

                    $_SESSION['valide'] = 'Les modifications ont bien été prises en compte. Veuillez vous reconnecter pour mettre à jour les informations';
                    $main->logout();
                    header('Location: /login');
                    unset($_SESSION['update']);
                    exit;
                } else {
                    $_SESSION['valide'] = "Aucune modification n'a été effectué.";
                    unset($_SESSION['update']);
                }
            }
        }

        $roles = preg_split("[\"]", $_SESSION['user']['role']);
        $role = $roles[1];

        $error = $_SESSION['erreur'];
        $valide = $_SESSION['valide'];

        $donnees = array ("role" => $role, "error" => $error, "valide" => $valide);

        $this->render('profile/index', $donnees, 'auth');
    }

    public function delete()
    {
        if(isset($_POST['delete'])){
            
            $user = new UserModel;

            if(password_verify($_POST['password'], $_SESSION['user']['password'])){
                $user->delete($_SESSION['user']['idUser']);
            
                $main = new MainController;
                $main->logout();
                header('Location: /');
                exit;
            } else {
                $_SESSION['erreur'] = 'Le mot de passe est incorrect';
            }
        }
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

    public function validateMail(string $mail)
    {
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $_SESSION['erreur'] = "L'adresse mail n'est pas valide.";
            return false;
        }
        return true;
    }

    public function alreadyUse(string $donnee, string $type)
    {
        $user = new UserModel;
        $tab = $user->findAllBy($type);
        for($i = 0; $i < count($tab); $i++){

            if ($donnee == $tab[$i]["$type"] && $tab[$i]["$type"] != $_SESSION['user']["$type"]){
                $_SESSION['erreur'] = ucfirst($type)." déjà utilisé";
                return false;
            }
        }
        return true;
    }
}
