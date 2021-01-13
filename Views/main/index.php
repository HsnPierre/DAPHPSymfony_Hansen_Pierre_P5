<div class="container">
    <h1 class="text-center">Qui suis-je ?</h1>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius praesentium recusandae illo eaque architecto error, repellendus iusto reprehenderit, doloribus, minus sunt. Numquam at quae voluptatum in officia voluptas voluptatibus, minus!</p>
        </div>
    </div>
</div>
<hr>
<div class="container">
    <h2 class="text-center">Mes actualités</h2>
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
<hr>
<div class="container">
    <h2 class="text-center"> Mes projets</h2>
    <div class="col-lg-8 col-md-10 mx-auto">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?</p>
    </div>
    <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="5000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExample" data-slide-to="1"></li>
            <li data-target="#carouselExample" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="img/project-bg.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <a href="">
                    <h5>Projet 1</h5>
                    <p></p>
                </a> 
            </div>
            </div>
            <div class="carousel-item">
            <img src="img/project-bg.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <a href="">
                    <h5>Projet 2</h5>
                    <p></p>
                </a>    
            </div>
            </div>
            <div class="carousel-item">
            <img src="img/project-bg.jpg" class="d-block w-100" alt="...">
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
<hr>
<div class="container" id="contactform">
    <h2 class="text-center">Me contacter</h2>
    <form action="#contactform" method="post" id="contact">
        <div class="error text-center">
            <?= $error ?>
        </div>
        <div class="valide text-center">
            <?= $valide ?>
        </div>
        <div class="row g-3 align-items-center">
            <div class="form-group col">
                <label for="nom" class="form-label">Nom</label>
                <input class="form-control" type="text" name="nom">
            </div>
            
            <div class="form-group col">
                <label for="prenom" class="form-label">Prenom</label>
                <input class="form-control" type="text" name="prenom">
            </div>
        </div>
        
        <div class="form-group">
            <label for="mail" class="form-label">Adresse mail</label>
            <input class="form-control" type="text" placeholder="exemple@domaine.fr" name="mail">
        </div>
        
        <div class="form-group">
            <label for="objet" class="form-label">Sujet</label>
            <input class="form-control" type="text" name="objet">
        </div>
        
        <div class="form-group">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" name="message"></textarea>
        </div>

        <div class="form-group text-center">
            <button class="btn btn-primary" type="submit" name="contact">Envoyer</button>
        </div>
    </form>
</div>
<hr>
