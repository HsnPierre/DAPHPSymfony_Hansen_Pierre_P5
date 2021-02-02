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
            if($register->isEmpty(Post::raw(), ['nom', 'prenom', 'pseudonyme', 'mail', 'password', 'password2']) && $register->validateMail(Post::get('mail')) && $register->validatePass(Post::get('password'), Post::get('password2'))){
                $mail = Post::get('mail');
                $pass = password_hash(Post::get('password'), PASSWORD_BCRYPT);
                $nom = strip_tags(Post::get('nom'));
                $prenom = strip_tags(Post::get('prenom'));
                $pseudo = strip_tags(Post::get('pseudonyme'));

                

                if($register->alreadyUse($pseudo, 'username') && $register->alreadyUse($mail, 'email')){
                    
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
        $i = 0;
        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ]) && $champ != 'password2'){
                if($champ == 'password'){
                    Session::put3d('erreur', $i, "Le champ mot de passe ne peut pas être vide");
                    $i++;
                }else{
                    Session::put3d('erreur', $i, "Le champ ".$champ." ne peut pas être vide.");
                    $i++;
                }
            }
        }
    }

    public function validateMail(string $mail)
    {
        Session::put('erreur', []);
        $i = 0;

        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            Session::put3d('erreur', $i, "L'adresse mail n'est pas valide.");
            $i++;
        }
    }

    public function validatePass(string $pass, string $pass2)
    {
        $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{12,}$/';
        $i = 0;

        if(!preg_match($pattern, $pass)){
            Session::put3d('erreur', $i, 'Le mot de passe doit contenir au minimum');
            if(!preg_match('/^(?=.*[a-z]).{12,}$/', $pass)){
                Session::put3d('erreur', $i, "une minuscule");
            }   
            if(!preg_match('/^(?=.*[A-Z]).{12,}$/', $pass)){
                Session::put3d('erreur', $i, "une majuscule");
            }   
            if(!preg_match('/^(?=.*[0-9]).{12,}$/', $pass)){
                Session::put3d('erreur', $i, "un chiffre");
            }   
            if(!preg_match('/^(?=.*[!@#$%^&*-]).{12,}$/', $pass)){
                Session::put3d('erreur', $i, "un caractère spécial");
            }
            if(!preg_match('/^.{12,}$/', $pass)){
                Session::put3d('erreur', $i, "et contenir au minimum 12 caractères");
            } 
            $i++;
        }

        if ($pass != $pass2){
            Session::put3d('erreur', $i, "Les deux mots de passe ne se correspondent pas.");
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
        Session::put('erreur', []);
        $j = 0;
        for($i = 0; $i < count($tab); $i++){

            if ($donnee == $tab[$i]["$type"]){
                Session::put3d('erreur', $j, '"'.$donnee.'"'." est déjà utilisé");
                $j++;
            }
        }
        if($j > 0){
            return false;
        }
        return true;
    }
}