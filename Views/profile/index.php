<?php if(!isset($_POST['update']) && !isset($_SESSION['update']) && !isset($_POST['password']) && !isset($_SESSION['password'])): ?>
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
            <?php
                for($i = 0; $i < count($_SESSION['erreur']); $i++){
                    echo $_SESSION['erreur'][$i].'<br>';
                }
                unset($_SESSION['erreur']); 
            ?>
            </div>
        <?php endif; ?>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <form method='post'><button class='btn' name="password">Changer le mot de passe</button></form>
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
                <input class="form-control" type="password" name="mdp">
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-danger" type="submit" name="delete">Supprimer le compte</button>
                <button class="btn btn-secondary" onclick="closeDelete()">Annuler</button>
            </div>
	</form>
</div>

<? elseif(isset($_POST['update']) || isset($_SESSION['update'])): ?>

<div class="container" id="profil-update">
    <div class="main-body">

        <h2 class="text-center">Editer</h2>

        <?php if(isset($_SESSION['erreur'])): ?>
            <div class="alert alert-danger text-center" role ="alert">
            <?php
                for($i = 0; $i < count($_SESSION['erreur']); $i++){
                    echo $_SESSION['erreur'][$i].'<br>';
                }
                unset($_SESSION['erreur']); 
            ?>
            </div>
        <?php endif; ?>
    
        
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?= $_SESSION['user']['pic']; ?>" alt="Photo de profil" class="rounded-circle" width="150">
                            
                            <form method='post' enctype="multipart/form-data">
                                <div class="container">
                                    <input class="form-control" type="file" id="formFile" name='picture'>
                                    <button class='btn btn-secondary' name="pic">Envoyer</button>
                                </div>
                            </form>
                            
                            <div class="mt-3">
                                <h4><?= $_SESSION['user']['surname'].' '.$_SESSION['user']['name']; ?></h4>
                                <p class="text-secondary mb-1"><?= $role; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-8">
            <form method="post" id="modif">
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
        
            <div class="form-group text-center">
                <button class="btn btn-primary" type="submit" name="modif" id="modif">Modifier</button>
            </div>

        </form>
    </div>
</div>

<? elseif(isset($_POST['password']) || isset($_SESSION['password'])): ?>

<h2 class='text-center'>Changer le mot de passe</h2>

    <?php if(isset($_SESSION['erreur'])): ?>
        <div class="alert alert-danger text-center" role ="alert">
        <?php
            for($i = 0; $i < count($_SESSION['erreur']); $i++){
                echo $_SESSION['erreur'][$i].'<br>';
            }
            unset($_SESSION['erreur']); 
        ?>
        </div>
    <?php endif; ?>

<form method="post">

    <div class="row form-group justify-content-end">
        <button class="btn btn-danger col-2 justify-content-end" type="submit" name="back">Annuler</button>
    </div> 

    <div class="container">
        <div class="form-group">
            <label for="password" class="form-label">Ancien mot de passe</label>
            <input class="col form-control" type="password" placeholder="" name="old">
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input class="col form-control" type="password" placeholder="" name="new">
        </div>

        <div class="form-group">
            <label for="password2" class="form-label">Confirmer mot de passe</label>
            <input class="col form-control" type="password" placeholder="" name="new2">
        </div>

        <div class="form-group text-center">
            <button class="btn btn-primary" type="submit" name="pass" id="pass">Envoyer</button>
        </div>
    </div>

</form>

<? endif; ?>
