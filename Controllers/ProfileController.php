<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Core\Session;
use App\Core\Post;
use App\Core\File;

class ProfileController extends Controller
{
    public function index()
    {

        if(Session::get3d('user', 'idUser') === null){
            $donnees = array ("title" => 'Erreur', "subtitle" => "Vous devez vous <a href='/auth'>inscrire</a> ou vous <a href='/login'>connecter</a> accéder à la page demandée.");
            $this->render('error/index', $donnees, 'auth');
            exit;
        }

        $profile = new ProfileController;

        if(Post::get('update') !== null || Session::get('update') !== null){
            $profile->update();
        }

        if(Post::get('delete') !== null){
            $profile->delete();
        }

        if(Post::get('pic') !== null){
            $profile->updatePic();
        }

        if(Post::get('password') !== null || Session::get('password') !== null){
            $profile->updatePassword();
        }

        $donnees = array ("title" => 'Mon profil');

        $this->render('profile/index', $donnees, 'auth');
    }

    public function update()
    {
        $profile = new ProfileController;
        $register = new RegisterController;
        Session::put('update', '');
        Session::put('idUser', Session::get3d('user', 'idUser'));


        if(Post::get('modif') !== null && $profile->isEmpty(Post::raw(), ['nom', 'prenom', 'pseudo', 'mail']) && $register->validateMail(Post::get('mail'))){
            
            if($profile->alreadyUse(Post::get('pseudo'), 'username') && $profile->alreadyUse(Post::get('mail'), 'email')){
                $compteur = 0;
                $user = new UserModel;
                $pseudo = strip_tags(Post::get('pseudo'));
                $mail = Post::get('mail');
                $nom = strip_tags(Post::get('nom'));
                $prenom = strip_tags(Post::get('prenom'));

                if($pseudo != Session::get3d('user', 'username')){
                    $user->setUsername($pseudo);
                    $compteur++;
                }
                if($mail != Session::get3d('user', 'email')){
                    $user->setEmail($mail);
                    $compteur++;
                }
                if($nom != Session::get3d('user', 'name')){
                    $user->setName($nom);
                    $compteur++;
                }
                if($prenom != Session::get3d('user', 'surname')){
                    $user->setSurname($prenom);
                    $compteur++;
                }
                if($compteur > 0){
                    $user->update();
                    
                    $main = new MainController;

                    Session::put('valide', "Les modifications ont bien été prises en compte. Veuillez vous reconnecter pour mettre à jour les informations");
                    $main->logout();
                    header('Location: /login');
                    Session::forget('update');
                    exit;
                } else {
                    Session::put('valide', "Aucune modification n'a été effectué.");
                    Session::forget('update');
                }
            }
        }
    }

    public function updatePic()
    {
        $profile = new ProfileController;
        $user = new UserModel;

        if(File::get3d('picture', 'name') != ""){

            if($profile->validatePic(File::get('picture'))){
                $fileExt = pathinfo(File::get3d('picture', 'name'));
                $tmpName = File::get3d('picture', 'tmp_name');
                $uniqueName = md5(uniqid(rand(), true));
                $fileName = "img/".$uniqueName.'.'.$fileExt;
                if(move_uploaded_file($tmpName, $fileName)){
                    Session::put3d('user', 'pic', $fileName);
                    Session::put('idUser', Session::get3d('user', 'idUser'));
                    $user->setPic($fileName);
                    $user->update();  
                    header('Location: /profile');                  
                } else {
                    Session::put3d('erreur', 0, "Une erreur est survenue lors du téléchargement de l'image.");
                }
            }
        } else {
            Session::put3d('erreur', 0, "Le fichier ne peut pas être vide.");
        }
    }

    public function updatePassword()
    {
        $profile = new ProfileController;
        $user = new UserModel;
        Session::put('password', '');

        if(Post::get('back') !== null){
            Session::forget('password');
            header('Location: /profile');
            exit;
        }

        if(Post::get('pass') !== null && $profile->isEmpty(Post::raw(), ['old', 'new', 'new2']) && $register->validatePass(Post::get('new'), Post::get('new2'))){
        
            if(password_verify(Post::get('old'), Session::get3d('user', 'password'))){
            
                $pass = password_hash(Post::get('new'), PASSWORD_BCRYPT);
                $user->setPassword($pass);
                Session::put('idUser', Session::get3d('user', 'idUser'));
                $user->update();

                $main = new MainController;

                Session::put('valide', "Les modifications ont bien été prises en compte. Veuillez vous reconnecter pour mettre à jour les informations");
                $main->logout();
                header('Location : /login');
                Session::forget('password');
                exit;
            } else {
                Session::put3d('erreur', 0, "Mot de passe incorrect");
            }
        }
    }

    public function delete()
    {
        if(Post::get('delete') !== null){
            
            $user = new UserModel;

            if(password_verify(Post::get('mdp'), Session::get3d('user', 'password'))){
                $user->delete(Session::get3d('user', 'idUser'));
            
                $main = new MainController;
                $main->logout();
                header('Location: /');
                exit;
            } else {
                Session::put('erreur', "Le mot de passe est incorrect");
            }
        }
    }

    public function isEmpty(array $donnees, array $champs)
    {
        Session::put('erreur', []);
        $compteur = 0;
        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ])){
                if($champ == 'mdp'){
                    Session::put3d('erreur', $compteur, "Le champ mot de passe ne peut pas être vide");
                    $compteur++;
                } else
                if($champ == 'old'){
                    Session::put3d('erreur', $compteur, "Le champ ancien mot de passe ne peut pas être vide");
                    $compteur++;
                } else
                if($champ == 'new'){
                    Session::put3d('erreur', $compteur, "Le champ nouveau mot de passe ne peut pas être vide");
                    $compteur++;
                } else
                if($champ == 'new2'){
                    Session::put3d('erreur', $compteur, "Le champ confirmer mot de passe ne peut pas être vide");
                    $compteur++;
                } else {
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

    public function validatePic(array $donnees)
    {
        $compteur = 0;
        $maxSize = 500000;
        $validExt = array('jpg', 'jpeg', 'png');

        if($donnees['error'] > 0){
            Session::put3d('erreur', $compteur, "Une erreur est survenue durant le transfert du fichier.");
            $compteur++;
        }
        if($donnees['size'] > $maxSize){
            Session::put3d('erreur', $compteur, "Le fichier envoyé est trop volumineux.");
            $compteur++;
        }
        
        $fileExt = pathinfo($donnees['name']);

        if(!in_array($fileExt['extension'], $validExt)){
            Session::put3d('erreur', $compteur, 'Seuls les fichiers ".jpg", ".jpeg", ".png" sont acceptés');
            $compteur++;
        }

        if(!stristr($donnees['type'], "image")){
            Session::put3d('erreur', $compteur, "Le fichier envoyé n'est pas une image");
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
        for($compteur = 0; $compteur < count($tab); $compteur++){

            if ($donnee == $tab[$compteur]["$type"] && $tab[$compteur]["$type"] != Session::get3d('user', "$type")){
                Session::put3d('erreur', $compteur, ucfirst($type)." déjà utilisé");
                return false;
            }
        }
        return true;
    }
}
