<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Core\Session;
use App\Core\Post;

class MainController extends Controller
{
    public function index()
    {
        $main = new MainController;
        $login = new LoginController;
        $blog = new BlogController;

        if(Post::raw() !== null){
            if(Post::get('pseudo') !== null){
                $login->login();
            } else if(Post::get('nom') !== null){
                $main->contactform();
            }
        }

        $tmp = $blog->showPost('date', 'DESC');
        extract($tmp);

        $donnees = array ("title" => "Pierre Hansen", "subtitle" => "Apprenti développeur d'application web", "image" => "https://www.heberger-image.fr/images/2021/01/21/home-bg.jpg", "valeurs" => $valeurs, "user" => $user);

        $this->render('main/index', $donnees);
    }
    
    public function contactform()
    {
        $main = new MainController;

        if(!empty(Post::raw()) && $main->validate(Post::raw(), ['nom', 'prenom', 'mail', 'objet', 'message']) && $main->validateMail(Post::get('mail'))){
            
            $mail = Post::get('mail');
            $nom = strip_tags(Post::get('nom'));
            $prenom = strip_tags(Post::get('prenom'));
            $objet = strip_tags(Post::get('objet'));
            $message = strip_tags(Post::get('message'));

            $mailto = 'pierre.hsn@gmail.com';

            $header = "MIME-Version: 1.0\r\n";
            $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";

            $header .= 'To: Vous <' . $mailto . '>' . "\r\n";
            $header .= 'From:' . $nom . ' ' . $prenom . ' <' . $mail . '>' . "\r\n";

            $message = "<html>
                            <head>
                            </head>
                            <body>
                                <p>" .
                                    $nom . ' ' . $prenom . ',<br>
                                    Sujet : ' . $objet . ',<br>
                                    Message : ' . $message . "
                                </p>
                            </body>
                        </html>";

            if(mail($mailto, $objet, $message, $header)){
                Session::put('valide', "Le formulaire a bien été envoyé");
            } else {
                Session::put('erreur', "Une erreur est survenue lors de l'envoi du formulaire");
            }
        }
    }

    public function validate(array $donnees, array $champs)
    {
        foreach($champs as $champ){
            if(!isset($donnees[$champ]) || empty($donnees[$champ])){
                if($champ == 'mdp'){
                    Session::put('erreur', "Le champ mot de passe ne peut pas être vide");
                    return false;
                }
                Session::put('erreur', "Le champ ".$champ." ne peut pas être vide.");
                return false;
            }
        }
        return true;
    }

    public function validateMail(string $mail)
    {
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            Session::put('erreur', "L'adresse mail n'est pas valide.");
            return false;
        }
        return true;
    }

    public function logout(){
        $tab = explode('/', filter_input(INPUT_SERVER, 'HTTP_REFERER'));
        Session::forget('user');
        if($tab[3] == 'profile' || $tab[3] == 'admin'){
            header('Location: /');
        } else {
            header('Location: '. filter_input(INPUT_SERVER, 'HTTP_REFERER'));
        }
    }
}