<?php $title = "Welcome !";
$subtitle ="Lorem ipsum dolor sit amet";
$image ="img/home-bg.jpg";

if(!empty($_POST)){
    extract($_POST);
    $valid = true;

    if(isset($_POST['contact'])){
        $nom = (String) htmlentities(trim($nom));
        $prenom = (String) htmlentities(trim($prenom));
        $mail = (String) htmlentities(strtolower(trim($mail)));
        $objet = (String) htmlentities(trim($objet));
        $message = (String) htmlentities(trim($message));

        if(empty($nom)){
            $valid = false;
            $er_nom = ("Le champs nom ne peut pas être vide");
        }

        if(empty($prenom)){
            $valid = false;
            $er_prenom = ("Le champs prenom ne peut pas être vide");
        }

        if(empty($mail)){
            $valid = false;
            $er_mail = ("Le champs adresse mail ne peut pas être vide");
        } elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)) {
            $valid = false;
            $er_mail = ("L'adresse mail n'est pas valide");
        }

        if(empty($objet)){
            $valid = false;
            $er_objet = ("Le champs sujet ne peut pas être vide");
        }

        if(empty($message)){
            $valid = false;
            $er_message = ("Le champs message ne peut pas être vide");
        }

        if($valid){

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
                echo 'Le formulaire a bien été envoyé';
            } else {
                echo "Une erreur est survenue lors de l'envoi du formulaire";
            }

        }

    }
}

?>

<div class="container">
    <h2 class="text-center">Inscription</h2>
    <form method="post">
        <div class="row g-3 align-items-center">
            <div class="form-group col">
                <label for="nom" class="form-label">Nom</label>
                <input class="form-control" type="text" name="nom" value="<?php if(isset($nom)){ echo $nom; }?>">
            </div>
            <?php
                if(isset($er_nom)){
                ?>
                    <div class="er-msg"><?= $er_nom ?></div>
                <?php
                }
            ?>
            
            <div class="form-group col">
                <label for="prenom" class="form-label">Prenom</label>
                <input class="form-control" type="text" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }?>">
            </div>
            <?php
                if(isset($er_prenom)){
                ?>
                    <div class="er-msg"><?= $er_prenom ?></div>
                <?php
                }
            ?>
        </div>

        <div class="form-group">
            <label for="pseudo" class="form-label">Pseudonyme</label>
            <input class="form-control" type="text" name="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo; }?>">
        </div>
        <?php
            if(isset($er_prenom)){
            ?>
                <div class="er-msg"><?= $er_prenom ?></div>
            <?php
            }
        ?>
        
        <div class="form-group">
            <label for="mail" class="form-label">Adresse mail</label>
            <input class="form-control" type="email" placeholder="exemple@domaine.fr" name="mail" value="<?php if(isset($mail)){ echo $mail; }?>">
        </div>
        <?php
            if(isset($er_mail)){
            ?>
                <div class="er-msg"><?= $er_mail ?></div>
            <?php
            }
        ?>
        
        <div class="form-group">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input class="form-control" type="password" placeholder="" name="mdp" value="<?php if(isset($pass)){ echo $pass; }?>">
        </div>

        <div class="form-group">
            <label for="" class="form-label">Confirmer mot de passe</label>
            <input class="form-control" type="password" placeholder="" name="" value="">
        </div>

        <div class="form-group text-center">
            <button class="btn btn-primary" type="submit" name="contact">S'inscrire</button>
        </div>
    </form>
</div>
<hr>
