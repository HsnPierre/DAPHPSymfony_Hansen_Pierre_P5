<?php $title = "Welcome !"; ?>
<?php $subtitle ="Phrase d'accroche à trouver"; ?>
<?php $image ="public/img/home-bg.jpg"; ?>

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
    <form>
        <div class="row g-3 align-items-center">
            <div class="mb-3 col">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="mb-3 col">
                <label for="surname" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="surname">
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Adresse mail</label>
            <input type="email" class="form-control" id="email" placeholder="name@example.fr">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" rows="3"></textarea>
        </div>
        <div class="button">
            <button type="submit">Envoyer</button>
        </div>
    </form>
</div>
<br><hr>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>