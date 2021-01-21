<?php
namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends Controller
{
    public function index()
    {
        $auth = new AuthController;

        if(isset($_SESSION['user']['idUser'])){
            header('Location: /main');
        }

        if(isset($_POST['rgpd'])){
            if($auth->validate($_POST, ['nom', 'prenom', 'pseudonyme', 'mail', 'password', 'password2']) && $auth->validatePassword($_POST['password'])){
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
        } elseif(!empty($_POST)) {
            $_SESSION['erreur'] = "Vous devez accepter les conditions pour pouvoir vous inscrire.";
        }

        $donnees = array ("title" => 'Inscription');

        $this->render('auth/index', $donnees, 'auth');
    }

    public function validate(array $donnees, array $champs)
    {
        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ])){
                $_SESSION['erreur'] = "Le champ ".$champ." ne peut pas être vide.";
                return false;
            } else if(!filter_var($donnees["mail"], FILTER_VALIDATE_EMAIL)){
                $_SESSION['erreur'] = "L'adresse mail n'est pas valide.";
                return false;
            } else if ($donnees["password"] != $donnees["password2"]){
                $_SESSION['erreur'] = "Les deux mots de passe ne se correspondent pas.";
                return false;
            }
        }
        return true;
    }

    public function validatePassword(string $password)
    {
        $maj = 0;
        $min = 0;
        $digit = 0;
        $spec = 0;
        foreach(count_chars($password, 1) as $i => $val){
            if(ctype_lower(chr($i))){
                $min++;
            } else if(ctype_upper(chr($i))){
                $maj++;
            } else if(ctype_digit(chr($i))){
                $digit++;
            } else if(!ctype_alnum(chr($i))){
                $spec++;
            }
        }

        if($maj > 0 && $min > 0 && $digit > 0 && $spec > 0 && strlen($password) > 7){
            return true;
        } else {
            $_SESSION['erreur'] = 'Le mot de passe doit contenir au moins une minuscule, une majsucule, un chiffre, un caractère spécial et faire au moins 8 caractères';
            return false;
        }
    }

    public function alreadyUse(string $donnee, string $type)
    {
        $user = new UserModel;
        $tab = $user->findAllBy($type);
        for($i = 0; $i < count($tab); $i++){

            if ($donnee == $tab[$i]["$type"]){
                $_SESSION['erreur'] = '"'.$donnee.'"'." est déjà utilisé";
                return false;
            }
        }
        return true;
    }
}