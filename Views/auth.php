<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8">
        <title><?= strip_tags($title) ?></title>

        <!-- Bootstrap core CSS -->
        <link href="<?= HOST ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <!-- Custom fonts for this template -->
        <link href="<?= HOST ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

        <!-- Custom styles for this template -->
        <link href="<?= HOST ?>css/clean-blog.min.css" rel="stylesheet">

    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= HOST ?>main">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= HOST ?>blog">Blog</a>
                        </li>
                        <?php use App\Core\Session; $role = json_decode(Session::get3d('user', 'role')); if(Session::get3d('user', 'idUser') !== null && !in_array('Administrateur', $role)): ?>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= HOST ?>profile">Mon profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= HOST ?>main/logout">Deconnexion</a>
                            </li>

                            <?php elseif(in_array('Administrateur', $role)): ?>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= HOST ?>profile">Mon profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= HOST ?>admin">Administration</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= HOST ?>main/logout">Deconnexion</a>
                            </li>

                            <?php else: ?>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= HOST ?>register">S'inscrire</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= HOST ?>login">Se connecter</a>
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
                        <input class="form-control" type="text" name="pseudo" value="<?php if(isset($pseudo)){?> <?= strip_tags($pseudo) ?> <?php } ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="mdp" class="form-label">Mot de passe</label>
                        <input class="form-control" type="password" placeholder="" name="mdp" value="<?php if(isset($pass)){?> <?= strip_tags($pass) ?> <?php } ?>">
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

        <!-- Footer -->
        <footer>
        <hr>
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
                            
                            </li>
                            <li class="list-inline-item">
                            <a href="https://github.com/HsnPierre">
                                <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            </li>
                        </ul>

                        <?php if(in_array('Administrateur', $role)): ?>
                        <a class='col btn text-center' href="/admin" role='button'>Administration</a>
                        <?php endif; ?>

                        <p class="copyright text-muted">Copyright &copy; Hansen Pierre 2020</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="<?= HOST ?>vendor/jquery/jquery.min.js"></script>
        <script src="<?= HOST ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Custom scripts for this template -->
        <script src="<?= HOST ?>js/clean-blog.min.js"></script>
        <script src="<?= HOST ?>js/script.js"></script>
        <script src="<?= HOST ?>js/delete.js"></script>

    </body>
</html>