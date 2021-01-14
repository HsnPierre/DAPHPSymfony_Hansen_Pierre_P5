<?php if(stristr($_SESSION['user']['role'], "Administrateur") != false): ?>
<nav class="nav flex-column">
    <div>
        <a href="">Posts</a>
        <a href="">Commentaires</a>
        <a href="">Utilisateurs</a>
    </div>
</nav>

<?php/*

button addPost()
Afficher les articles par ordre chrono décroissant (showPost)
button Update (updatePost()) / delete (deletePost()) sur chaque article

Affichers les commentaires en attente
Commentaires soumis (stockés en bdd) par ordre chrono décroissant
Bouton valider ou refuser sur chaque comm, valider = update estValidé -> 1 / refuser = delete comm bdd

Afficher les utilisateurs + bouton ajouter le role admin

 */
?>


<?php if((!isset($_POST['edit']) && !isset($_SESSION['edit'])) && (!isset($_POST['add']) && !isset($_SESSION['add']))): ?>

<div class='container' id='showPost'>

    <h2 class='text-center'>Liste des annonces postées</h2>

    <?php if(isset($_SESSION['valide'])): ?>
        <div class="alert alert-success text-center" role="alert">
            <?= $_SESSION['valide']; unset($_SESSION['valide']); ?>
        </div>
    <?php endif; ?>

    <form action=' ' method='post' id='add' class='text-center'>
        <button class='btn btn-primary' name='add'>Ajouter</button>
    </form>

    <?php
    $valeurs = $_SESSION['content'];
    for($i = 0; $i < count($valeurs); $i++){
        echo $valeurs[$i];
    }
    ?>
</div>

<?php elseif(isset($_POST['add']) || isset($_SESSION['add'])): ?>

<div class='container' id='addPost'>

    <form method="post" id="addPost">

        <div class="row form-group justify-content-end">
            <button class="btn btn-danger col-2 justify-content-end" type="submit" name="back">Annuler</button>
        </div>    
        
        <h2 class='text-center'>Ajouter une annonce</h2>

        <?php if(isset($_SESSION['erreur'])): ?>
            <div class="alert alert-danger text-center" role ="alert">
                <?= $_SESSION['erreur']; unset($_SESSION['erreur']); ?>
            </div>
        <?php endif; ?>

        <div class="form-group col">
            <label for="titre" class="form-label">Titre</label>
            <input class="form-control" type="text" name="titre">
        </div>
            
        <div class="form-group col">
            <label for="chapo" class="form-label">Chapô</label>
            <input class="form-control" type="text" name="chapo">
        </div>
        
        <div class="form-group col">
            <label for="contenu" class="form-label">Contenu</label>
            <textarea class="form-control" name="contenu"></textarea>
        </div>

        <div class="row form-group justify-content-center">
            <button class="btn btn-primary col-2" type="submit" name="addPost">Ajouter</button>
        </div>

    </form>

</div>

<?php elseif(isset($_POST['edit']) || isset($_SESSION['edit'])): ?>

<div class='container' id='updatePost'>

    <form method="post" id="updatePost">        

        <div class="row form-group justify-content-end">
            <button class="btn btn-danger col-2 justify-content-end" type="submit" name="back">Annuler</button>
        </div>    
        
        <h2 class='text-center'>Editer une annonce</h2>

        <?php if(isset($_SESSION['erreur'])): ?>
            <div class="alert alert-danger text-center" role ="alert">
                <?= $_SESSION['erreur']; unset($_SESSION['erreur']); ?>
            </div>
        <?php endif; ?>

        <div class="form-group col">
            <label for="titre" class="form-label">Titre</label>
            <input class="form-control" type="text" name="titre" value="<?= $_SESSION['titre'] ?>">
        </div>
            
        <div class="form-group col">
            <label for="chapo" class="form-label">Chapô</label>
            <input class="form-control" type="text" name="chapo" value="<?= $_SESSION['chapo'] ?>">
        </div>
        
        <div class="form-group col">
            <label for="contenu" class="form-label">Contenu</label>
            <textarea class="form-control" name="contenu"><?= $_SESSION['contenu'] ?></textarea>
        </div>

        <div class="form-group text-center">
            <button class="btn btn-primary" type="submit" name="updatePost">Ajouter</button>
        </div>

    </form>

</div>

<?php endif; ?>
<?php endif; ?>