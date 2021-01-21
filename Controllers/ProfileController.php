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

        if(isset($_POST['pic'])){
            $profile->updatePic();
        }

        if(isset($_POST['password']) || isset($_SESSION['password'])){
            $profile->updatePassword();
        }

        $donnees = array ("role" => $role, "title" => 'Mon profil');

        $this->render('profile/index', $donnees, 'auth');
    }

    public function update()
    {
        $profile = new ProfileController;
        $_SESSION['update'] = '';
        $_SESSION['idUser'] = $_SESSION['user']['idUser'];


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

    public function updatePic()
    {
        $profile = new ProfileController;
        $user = new UserModel;

        if($_FILES['picture']['name'] != ""){
            var_dump($_FILES);
            if($profile->validatePic($_FILES['picture'])){
                $fileExt = ".".strtolower(substr(strrchr($_FILES['picture']['name'], '.'), 1));
                $tmpName = $_FILES['picture']['tmp_name'];
                $uniqueName = md5(uniqid(rand(), true));
                $fileName = "img/".$uniqueName.$fileExt;
                echo $fileName;
                if(move_uploaded_file($tmpName, $fileName)){
                    $_SESSION['user']['pic'] = $fileName;
                    $_SESSION['idUser'] = $_SESSION['user']['idUser'];
                    $user->setPic($fileName);
                    $user->update();                    
                    header('Location: /profile');
                } else {
                    $_SESSION['erreur'] = "Une erreur est survenue lors du téléchargement de l'image.";
                }
            }
        } else {
            $_SESSION['erreur'] = "Le fichier ne peut pas être vide.";
        }
    }

    public function updatePassword()
    {
        $profile = new ProfileController;
        $auth = new AuthController;
        $user = new UserModel;
        $_SESSION['password'] = '';

        if(isset($_POST['back'])){
            unset($_SESSION['password']);
            header('Location: /profile');
            exit;
        }

        if(isset($_POST['pass']) && $profile->validate($_POST, ['old', 'new', 'new2']) && $auth->validatePassword($_POST['new'])){
        
            if(password_verify($_POST['old'], $_SESSION['user']['password'])){
            
                if($_POST['new'] == $_POST['new2']){
                    $pass = password_hash($_POST['new'], PASSWORD_BCRYPT);
                    $user->setPassword($pass);
                    $_SESSION['idUser'] = $_SESSION['user']['idUser'];
                    $user->update();

                    $main = new MainController;

                    $_SESSION['valide'] = 'Les modifications ont bien été prises en compte. Veuillez vous reconnecter pour mettre à jour les informations';
                    $main->logout();
                    header('Location: /login');
                    unset($_SESSION['password']);
                    exit;
                } else {
                    $_SESSION['erreur'] = 'Les deux mots de passe ne se correspondent pas';
                }
            } else {
                $_SESSION['erreur'] = 'Mot de passe incorrect';
            }
        }
    }

    public function delete()
    {
        if(isset($_POST['delete'])){
            
            $user = new UserModel;

            if(password_verify($_POST['mdp'], $_SESSION['user']['password'])){
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
                if($champ == 'old'){
                    $_SESSION['erreur'] = 'Le champ ancien mot de passe ne peut pas être vide';
                    return false;
                }
                if($champ == 'new'){
                    $_SESSION['erreur'] = 'Le champ nouveau mot de passe ne peut pas être vide';
                    return false;
                }
                if($champ == 'new2'){
                    $_SESSION['erreur'] = 'Le champ confirmer mot de passe ne peut pas être vide';
                    return false;
                }
                $_SESSION['erreur'] = "Le champ ".$champ." ne peut pas être vide.";
                return false;
            }
        }
        return true;
    }

    public function validatePic(array $donnees)
    {
        $maxSize = 500000;
        $validExt = array('.jpg', '.jpeg', '.png');

        if($donnees['error'] > 0){
            $_SESSION['erreur'] = 'Une erreur est survenue durant le transfert du fichier.';
            return false;
        }
        if($donnees['size'] > $maxSize){
            $_SESSION['erreur'] = 'Le fichier envoyé est trop volumineux.';
            return false;
        }
        
        $fileExt = ".".strtolower(substr(strrchr($donnees['name'], '.'), 1));

        if(!in_array($fileExt, $validExt)){
            $_SESSION['erreur'] = 'Seuls les fichiers ".jpg", ".jpeg", ".png" sont acceptés';
            return false;
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
