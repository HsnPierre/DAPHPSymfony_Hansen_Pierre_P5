<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Core\Session;
use App\Core\Post;

class RegisterController extends Controller
{
    public function index()
    {
        $register = new RegisterController;

        if(Session::get3d('user', 'idUser') !== null){
            header('Location: /main');
        }

        if(Post::get('rgpd') !== null){
            if($register->isEmpty(Post::raw(), ['nom', 'prenom', 'pseudonyme', 'mail', 'password', 'password2']) && $register->validateMail(Post::get('mail')) && $register->alreadyUse(Post::get('pseudonyme'), 'username') && $register->alreadyUse(Post::get('mail'), 'email') && $register->validatePass(Post::get('password'), Post::get('password2'))){
                $mail = Post::get('mail');
                $pass = password_hash(Post::get('password'), PASSWORD_BCRYPT);
                $nom = strip_tags(Post::get('nom'));
                $prenom = strip_tags(Post::get('prenom'));
                $pseudo = strip_tags(Post::get('pseudonyme'));
    
                $user = new UserModel;

                $user->setUsername($pseudo);
                $user->setPassword($pass);
                $user->setName($nom);
                $user->setSurname($prenom);
                $user->setEmail($mail);
                $user->setRole(json_encode(['Utilisateur']));
                $user->setRgpd(1);

                $user->create();

                Session::put('valide', "L'inscription a bien été prise en compte, vous pouvez dorénavant vous connecter");
                header('Location: /login');     
            }
        } elseif(Post::raw() !== null) {
            Session::put('ereur', "Vous devez accepter les conditions pour pouvoir vous inscrire.");
        }

        $donnees = array ("title" => 'Inscription');

        $this->render('register/index', $donnees, 'auth');
    }

    public function isEmpty(array $donnees, array $champs)
    {
        Session::put('erreur', []);
        $compteur = 0;
        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ]) && $champ != 'password2'){
                if($champ == 'password'){
                    Session::put3d('erreur', $compteur, "Le champ mot de passe ne peut pas être vide");
                    $compteur++;
                }else{
                    Session::put3d('erreur', $compteur, "Le champ ".$champ." ne peut pas être vide.");
                    $compteur++;
                }
            }
        }
        if($compteur > 0){
            return false;
        }
        return true;
    }

    public function validateMail(string $mail)
    {
        Session::put('erreur', []);
        $compteur = 0;

        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            Session::put3d('erreur', $compteur, "L'adresse mail n'est pas valide.");
            $compteur++;
        }
        if($compteur > 0){
            return false;
        }
        return true;
    }

    public function validatePass(string $pass, string $pass2)
    {
        $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{12,}$/';
        $compteur = 0;

        if(!preg_match($pattern, $pass)){
            Session::put3d('erreur', $compteur, 'Le mot de passe doit contenir au minimum');
            $compteur++;
            if(!preg_match('/^(?=.*[a-z]).{12,}$/', $pass)){
                Session::put3d('erreur', $compteur, "une minuscule");
                $compteur++;
            }   
            if(!preg_match('/^(?=.*[A-Z]).{12,}$/', $pass)){
                Session::put3d('erreur', $compteur, "une majuscule");
                $compteur++;
            }   
            if(!preg_match('/^(?=.*[0-9]).{12,}$/', $pass)){
                Session::put3d('erreur', $compteur, "un chiffre");
                $compteur++;
            }   
            if(!preg_match('/^(?=.*[!@#$%^&*-]).{12,}$/', $pass)){
                Session::put3d('erreur', $compteur, "un caractère spécial");
                $compteur++;
            }
            if(!preg_match('/^.{12,}$/', $pass)){
                Session::put3d('erreur', $compteur, "et contenir au minimum 12 caractères");
                $compteur++;
            } 
        }

        if ($pass != $pass2){
            Session::put3d('erreur', $compteur, "Les deux mots de passe ne se correspondent pas.");
            $compteur++;
        }
        if($compteur > 0){
            return false;
        }
        return true;
    }

    public function alreadyUse(string $donnee, string $type)
    {
        $user = new UserModel;
        $tab = $user->findAllBy($type);
        Session::put('erreur', []);
        $temp = 0;
        for($compteur = 0; $compteur < count($tab); $compteur++){

            if ($donnee == $tab[$compteur]["$type"]){
                Session::put3d('erreur', $temp, '"'.$donnee.'"'." est déjà utilisé");
                $temp++;
            }
        }
        if($temp > 0){
            return false;
        }
        return true;
    }
}