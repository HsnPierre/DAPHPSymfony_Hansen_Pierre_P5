<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8">
        <title><?= $title ?></title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

        <!-- Custom styles for this template -->
        <link href="css/clean-blog.min.css" rel="stylesheet">

    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="main">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog">Blog</a>
                        </li>
                        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['idUser']) && stristr($_SESSION['user']['role'], "Administrateur") == false): ?>

                            <li class="nav-item">
                                <a class="nav-link" href="profile">Mon profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="main/logout">Deconnexion</a>
                            </li>

                            <?php elseif(stristr($_SESSION['user']['role'], "Administrateur") != false): ?>

                            <li class="nav-item">
                                <a class="nav-link" href="profile">Mon profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin">Administration</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="main/logout">Deconnexion</a>
                            </li>

                            <?php else: ?>

                            <li class="nav-item">
                                <a class="nav-link" href="auth">S'inscrire</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" onclick="Popup()" href="#login">Se connecter</a>
                            </li>

                        <?php endif; ?>
                        
                    </ul>
                </div>
            </div>
        </nav>

        <div id="login">
            <form method="post" id="log">
                    <div class="form-group">
                        <label for="pseudo" class="form-label">Pseudonyme</label>
                        <input class="form-control" type="text" name="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo; }?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="mdp" class="form-label">Mot de passe</label>
                        <input class="form-control" type="password" placeholder="" name="mdp" value="<?php if(isset($pass)){ echo $pass; }?>">
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit" name="log">Se connecter</button>
                    </div>
            </form>
        </div>

        <!-- Page Header -->
        <header class="masthead">
                <div class="auth-heading">
                </div>
        </header>

        <!-- Main Content -->
            <div class="container">
                <?= $content; ?>
            </div>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Custom scripts for this template -->
        <script src="js/clean-blog.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/delete.js"></script>

    </body>
</html>