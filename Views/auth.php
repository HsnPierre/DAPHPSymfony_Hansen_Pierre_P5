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
                        <li class="nav-item">
                            <a class="nav-link" href="auth">S'inscrire</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="openPopup()">Se connecter</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="login">
            <form method="post">
                    <div class="form-group">
                        <label for="pseudo" class="form-label">Pseudonyme</label>
                        <input class="form-control" type="text" name="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo; }?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="mdp" class="form-label">Mot de passe</label>
                        <input class="form-control" type="password" placeholder="" name="mdp" value="<?php if(isset($pass)){ echo $pass; }?>">
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit" name="contact">Se connecter</button>
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

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            </li>
                            <li class="list-inline-item">
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            </li>
                            <li class="list-inline-item">
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            </li>
                        </ul>
                        <p class="copyright text-muted">Copyright &copy; Hansen Pierre 2020</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Custom scripts for this template -->
        <script src="js/clean-blog.min.js"></script>
        <script src="js/script.js"></script>

    </body>
</html>