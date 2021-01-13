<?php if(!isset($_POST['update']) && !isset($_SESSION['update'])): ?>
<div class="container" id="profil">
    <div class="main-body">

        <?php if(isset($_SESSION['valide'])): ?>
            <div class="alert alert-success text-center" role="alert">
                <?= $valide; unset($_SESSION['valide']); ?>
            </div>
        <?php endif; ?>

        <h2 class="text-center">Mon profil</h2>

        <?php if(isset($_SESSION['erreur'])): ?>
            <div class="alert alert-danger text-center" role ="alert">
                <?= $_SESSION['erreur']; unset($_SESSION['erreur']); ?>
            </div>
        <?php endif; ?>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="">Changer le mot de passe</a>
                        </li>                      
                    </ul>
                </div>
            </div>
        </nav>
    
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?= $_SESSION['user']['pic']; ?>" alt="Photo de profil" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?= $_SESSION['user']['surname'].' '.$_SESSION['user']['name']; ?></h4>
                                <p class="text-secondary mb-1"><?= $role; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nom</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $_SESSION['user']['name']; ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Prenom</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $_SESSION['user']['surname']; ?>
                            </div>
                        </div>
                        <hr>
                  
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Pseudo</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $_SESSION['user']['username']; ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $_SESSION['user']['email']; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <form method='post' id='update'>
            <div class="form-group text-center">
                <button class="btn btn-primary" type="submit" name="update" id="update">Modifier</button>
            </div>
        </form>

            <div class="form-group text-center">
                <button class="btn btn-danger" onclick="openDelete()">Supprimer le compte</button>
            </div>

    </div>
</div>

<div id="delete-form" class="container">
	<form method='post' id="delete">
            <h4>Supprimer le compte ?</h4>
            <p>
                Vous êtes sur le point de supprimer votre compte, pour confirmer cette action veuillez saisir votre mot de passe.
            </p>
            <div class="form-group">
                <label for="password" class="form-label">Mot de passe</label>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-danger" type="submit" name="delete">Supprimer le compte</button>
                <button class="btn btn-secondary" onclick="closeDelete()">Annuler</button>
            </div>
        </div>
	</form>
</div>

<? else: ?>

<div class="container" id="profil-update">
    <div class="main-body">

        <h2 class="text-center">Editer</h2>

        <?php if(isset($_SESSION['erreur'])): ?>
            <div class="alert alert-danger text-center" role ="alert">
                <?= $error; unset($_SESSION['erreur']); ?>
            </div>
        <?php endif; ?>
    
        <form method="post" id="modif">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="<?= $_SESSION['user']['pic']; ?>" alt="Photo de profil" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4><?= $_SESSION['user']['surname'].' '.$_SESSION['user']['name']; ?></h4>
                                    <p class="text-secondary mb-1"><?= $role; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nom</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="form-control" type="text" name="nom" value="<?= $_SESSION['user']['name']; ?>">
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Prenom</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="form-control" type="text" name="prenom" value="<?= $_SESSION['user']['surname']; ?>">
                                </div>
                            </div>
                            <hr>
                    
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Pseudo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="form-control" type="text" name="pseudo" value="<?= $_SESSION['user']['username']; ?>">
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input class="form-control" type="text" name="mail" value="<?= $_SESSION['user']['email']; ?>">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rgpd" required>
                <label class="form-check-label" for="rgpd">J'autorise ce site à conserver mes données personnelles transmises via ce formulaire. Aucune exploitation commerciale ne sera faite des données conservées.</label>
            </div>
        
            <div class="form-group text-center">
                <button class="btn btn-primary" type="submit" name="modif" id="modif">Modifier</button>
            </div>

        </form>
    </div>
</div>

<? endif; ?>
