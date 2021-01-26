<?php

namespace App\Controllers;

use App\Models\UserModel;

class MainController extends Controller
{
    public function index()
    {
        $main = new MainController;
        $login = new LoginController;
        $blog = new BlogController;

        if(isset($_POST)){
            if(isset($_POST['pseudo'])){
                $login->login();
            } else if(isset($_POST['nom'])){
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

        if(!empty($_POST) && $main->validate($_POST, ['nom', 'prenom', 'mail', 'objet', 'message']) && $main->validateMail($_POST['mail'])){
            var_dump($_POST);
            
            $mail = strip_tags($_POST['mail']);
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $objet = $_POST['objet'];
            $message = $_POST['message'];

            $to = 'pierre.hsn@gmail.com';

            $header = "MIME-Version: 1.0\r\n";
            $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";

            $header .= 'To: Vous <' . $to . '>' . "\r\n";
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

            if(mail($to, $objet, $message, $header)){
                $_SESSION['valide'] = "Le formulaire a bien été envoyé";
            } else {
                $_SESSION['erreur'] = "Une erreur est survenue lors de l'envoi du formulaire";
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

    public function logout(){
        $tab = explode('/', $_SERVER['HTTP_REFERER']);
        unset($_SESSION['user']);
        if($tab[3] == 'profile' || $tab[3] == 'admin'){
            header('Location: /');
        } else {
            header('Location: '. $_SERVER['HTTP_REFERER']);
        }
    }
}