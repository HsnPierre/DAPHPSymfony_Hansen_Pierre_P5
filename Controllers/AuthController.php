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
            if($auth->validate($_POST, ['nom', 'prenom', 'pseudonyme', 'mail', 'password', 'password2'])){
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
        $_SESSION['erreur'] = [];
        $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{12,}$/';
        $i = 0;
        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ]) && $champ != 'password2'){
                if($champ == 'password'){
                    $_SESSION['erreur'][] = "Le champ mot de passe ne peut pas être vide";
                }else{
                    $_SESSION['erreur'][] = "Le champ ".$champ." ne peut pas être vide.";
                    $i++;
                }
            }
        }
        if(!filter_var($donnees['mail'], FILTER_VALIDATE_EMAIL)){
            $_SESSION['erreur'][] = "L'adresse mail n'est pas valide.";
            $i++;
        }
        if(!preg_match($pattern, $donnees['password'])){
            $_SESSION['erreur'][] = 'Le mot de passe doit contenir au minimum';
            if(!preg_match('/^(?=.*[a-z]).{12,}$/', $donnees['password'])){
                $_SESSION['erreur'][] = 'une minuscule';
            }   
            if(!preg_match('/^(?=.*[A-Z]).{12,}$/', $donnees['password'])){
                $_SESSION['erreur'][] = 'une majuscule';
            }   
            if(!preg_match('/^(?=.*[0-9]).{12,}$/', $donnees['password'])){
                $_SESSION['erreur'][] = 'un chiffre';
            }   
            if(!preg_match('/^(?=.*[!@#$%^&*-]).{12,}$/', $donnees['password'])){
                $_SESSION['erreur'][] = 'un caractère spécial';
            }
            if(!preg_match('/^.{12,}$/', $donnees['password'])){
                $_SESSION['erreur'][] = 'et contenir au minimum 12 caractères';
            } 
            $i++;
        }
        if ($donnees["password"] != $donnees["password2"]){
            $_SESSION['erreur'][] = "Les deux mots de passe ne se correspondent pas.";
            $i++;
        }
        if($i > 0){
            return false;
        }
        return true;
    }

    public function alreadyUse(string $donnee, string $type)
    {
        $user = new UserModel;
        $tab = $user->findAllBy($type);
        $_SESSION['erreur'] = [];
        $j = 0;
        for($i = 0; $i < count($tab); $i++){

            if ($donnee == $tab[$i]["$type"]){
                $_SESSION['erreur'][] = '"'.$donnee.'"'." est déjà utilisé";
                $j++;
            }
        }
        if($j > 0){
            return false;
        }
        return true;
    }
}