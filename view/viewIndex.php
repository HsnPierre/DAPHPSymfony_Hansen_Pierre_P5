<?php $title = "Welcome !"; ?>
<?php $subtitle ="Phrase d'accroche à trouver"; ?>
<?php $image ="public/img/home-bg.jpg"; ?>

<?php

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

<?php ob_start(); ?>

<br>
<div class="container">
    <h1 class="text-center">Qui suis-je ?</h1>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius praesentium recusandae illo eaque architecto error, repellendus iusto reprehenderit, doloribus, minus sunt. Numquam at quae voluptatum in officia voluptas voluptatibus, minus!</p>
        </div>
    </div>
</div>
<br><hr>
<div class="container">
    <br>
    <h2 class="text-center">Mes actualités</h2>
    <br>
    <div class="row align-items-start text-center">
        <div class="post-preview col">
            <a href="">
                <h5 class="post-title"><small>Article récent 1</small></h5>
                <h6 class="post-subtitle">Lorem ipsum dolor sit amet</h6>
            </a>
            <p class="post-meta">Posté par <a href="#">AUTEUR</a> le DATE</p>
        </div>
        <div class="post-preview col">
            <a href="">
                <h5 class="post-title"><small>Article récent 2</small></h5>
                <h6 class="post-subtitle">Lorem ipsum dolor sit amet</h6>
            </a>
            <p class="post-meta">Posté par <a href="#">AUTEUR</a> le DATE</p>
        </div>
        <div class="post-preview col">
            <a href="">
                <h5 class="post-title"><small>Article récent 3</small></h5>
                <h6 class="post-subtitle">Lorem ipsum dolor sit amet</h6>
            </a>
            <p class="post-meta">Posté par <a href="#">AUTEUR</a> le DATE</p>
        </div>
    </div>
</div>
<br><hr>
<div class="container">
    <br>
    <h2 class="text-center"> Mes projets</h2>
    <br>
    <div class="col-lg-8 col-md-10 mx-auto">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?</p>
    </div>
    <br>
    <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="5000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExample" data-slide-to="1"></li>
            <li data-target="#carouselExample" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="public/img/project-bg.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <a href="">
                    <h5>Projet 1</h5>
                    <p></p>
                </a> 
            </div>
            </div>
            <div class="carousel-item">
            <img src="public/img/project-bg.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <a href="">
                    <h5>Projet 2</h5>
                    <p></p>
                </a>    
            </div>
            </div>
            <div class="carousel-item">
            <img src="public/img/project-bg.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <a href="">
                    <h5>Projet 3</h5>
                    <p></p>
                </a> 
            </div>
            </div>
        </div>
        <a href="#carouselExample" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a href="#carouselExample" class="carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<br><hr>
<div class="container">
    <br>
    <h2 class="text-center">Me contacter</h2>
    <br>
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
            <label for="objet" class="form-label">Sujet</label>
            <input class="form-control" type="text" name="objet" value="<?php if(isset($objet)){ echo $objet; }?>">
        </div>
        <?php
            if(isset($er_objet)){
            ?>
                <div class="er-msg"><?= $er_objet ?></div>
            <?php
            }
        ?>
        
        <div class="form-group">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" name="message"><?php if(isset($message)){ echo $message; }?></textarea>
        </div>
        <?php
            if(isset($er_message)){
            ?>
                <div class="er-msg"><?= $er_message ?></div>
            <?php
            }
        ?>

        <div class="form-group text-center">
            <button class="btn btn-primary" type="submit" name="contact">Envoyer</button>
        </div>
    </form>
</div>
<br><hr>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>