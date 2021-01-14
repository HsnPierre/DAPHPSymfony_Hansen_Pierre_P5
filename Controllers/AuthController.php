<?php
namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends Controller
{
    public function index()
    {
        $auth = new AuthController;

        if(!empty($_POST) && $auth->validate($_POST, ['nom', 'prenom', 'pseudonyme', 'mail', 'password', 'password2'])){
            $mail = strip_tags($_POST['mail']);
            $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $pseudo = $_POST['pseudonyme'];
            $date = date("d.m.y G:i:s T");

            if($auth->alreadyUse($pseudo, 'username') && $auth->alreadyUse($mail, 'email')){
                
                $user = new UserModel;

                $user->setUsername($pseudo);
                $user->setPassword($pass);
                $user->setName($nom);
                $user->setSurname($prenom);
                $user->setEmail($mail);
                $user->setRole(json_encode(['Utilisateur']));
                $user->setRgpd(1);

                $user->create();

                $_SESSION['valide'] = "L'inscription a bien été prise en compte, vous pouvez dorénavant vous connecter";
                header('Location: /login');
            }        
        }

        $error = $_POST['erreur'];

        $donnees = array ("error" => $error, "title" => 'Inscription');

        $this->render('auth/index', $donnees, 'auth');
    }

    public function validate(array $donnees, array $champs)
    {
        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ])){
                $_POST['erreur'] = "Le champ ".$champ." ne peut pas être vide.";
                return false;
            } else if(!filter_var($donnees["mail"], FILTER_VALIDATE_EMAIL)){
                $_POST['erreur'] = "L'adresse mail n'est pas valide.";
                return false;
            } else if ($donnees["password"] != $donnees["password2"]){
                $_POST['erreur'] = "Les deux mots de passe ne se correspondent pas.";
                return false;
            }
        }
        return true;
    }

    public function alreadyUse(string $donnee, string $type)
    {
        $user = new UserModel;
        $tab = $user->findAllBy($type);
        for($i = 0; $i < count($tab); $i++){

            if ($donnee == $tab[$i]["$type"]){
                echo ucfirst($type)." déjà utilisé";
                return false;
            }
        }
        return true;
    }
}