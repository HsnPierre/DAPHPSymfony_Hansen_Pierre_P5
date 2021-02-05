<div class="container">
    <h1 class="text-center">Qui suis-je ?</h1>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

            <div class="d-flex flex-column align-items-center text-center">
                <img id='home-pic' src="https://www.heberger-image.fr/images/2021/01/21/7056391b5bd1923887d11d471b25c293.png" alt="Pierre Hansen" class="rounded">
            </div>

            <p>Pierre Hansen, 21 ans. Passioné par l'informatique depuis très jeune je me suis très vite dirigé vers des études adéquates en licence informatique. Durant ces études, j'ai trouvé une vocation pour le développment web PHP, suite à quoi j'ai quitté la licence afin de m'orienter vers une formation spécialisée sur OpenClassroom. Formation dont je suis actuellement l'étudiant.</p>
            <p>Ce blog me permet de me présenter moi, mes qualifications, ainsi que les différents projets que j'ai mené ou auxquels j'ai participé, vous y trouverez mes actualités et un formulaire pour pouvoir me contacter.</p>
        </div>
    </div>
</div>
<hr>
<div class="container">
    <h2 class="text-center">Mes actualités</h2>
    <div class="row align-items-start text-center">
        <?php
        $i = 0;
        foreach($valeurs as $valeur){
            if($i < 3) {
                $nom = $user->findOneById('name', $valeur['idUser']);
                $prenom = $user->findOneById('surname', $valeur['idUser']);
                $date = date('\P\o\s\t\é \l\e d.m.y, \à H:i', strtotime($valeur['date']));
                $id = $valeur['idPost'];

                if(isset($valeur['editor']) && isset($valeur['dateEdit'])){
                    $dateEdit = date('\M\i\s \à \j\o\u\r \l\e d.m.y, \à H:i', strtotime($valeur['dateEdit']));
        ?>
                    <div class='post-preview col' id='post<?= strip_tags($id) ?>'>
                        <div class='text-center'><a href='blog/post/<?= strip_tags($id) ?>'><img src='https://www.heberger-image.fr/images/2021/01/14/post53a53974587df487.jpg' alt='Post Image' border='0' /></a></div>
                        <h3 class='post-title text-center'><a href='blog/post/<?= strip_tags($id) ?>'><?= strip_tags($valeur['title']) ?></a></h3>
                        <h5 class='post-subtitle text-center'><?= strip_tags($valeur['description']) ?></h5>
                        <p class='text-center'><?= strip_tags($date) ?> (<?= strip_tags($dateEdit) ?>)</p>
                        <p class='text-center'><?= strip_tags($prenom['surname']) ?> <?= strip_tags($nom['name']) ?> (édité par <?= strip_tags($valeur['editor']) ?>)</p>
                    </div>
        <?php
                    $i++;
                } else {
        ?>
                    <div class='post-preview col' id='post<?= strip_tags($id) ?>'>
                        <div class='text-center'><a href='blog/post/<?= strip_tags($id) ?>'><img src='https://www.heberger-image.fr/images/2021/01/14/post53a53974587df487.jpg' alt='Post Image' border='0' /></a></div>
                        <h3 class='post-title text-center'><a href='blog/post/<?= strip_tags($id) ?>'><?= strip_tags($valeur['title']) ?></a></h3>
                        <h5 class='post-subtitle text-center'><?= strip_tags($valeur['description']) ?></h5>
                        <p class='text-center'><?= strip_tags($date) ?></p>
                        <p class='text-center'><?= strip_tags($prenom['surname']) ?> <?= strip_tags($nom['name']) ?></p>
                    </div>
        <?php
                    $i++;
                }
            }
        }
        ?>
    </div>
</div>
<hr>
<div class="container">
    <h2 class="text-center"> Mes projets</h2>
    <div class="col-lg-8 col-md-10 mx-auto">
        <p>Voici les différents projets que j'ai pu mener dans le cadre de ma formation, s'ajouteront au fur et à mesure les différentes applications que j'aurais l'occasion de développer</p>
    </div>
    <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="5000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
            <?/*<li data-target="#carouselExample" data-slide-to="1"></li>
            <li data-target="#carouselExample" data-slide-to="2"></li>*/?>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="https://zupimages.net/up/21/03/km3m.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block bg-light">
                <a href="https://chaletscaviar.pierrehansen.com">
                    <h5>Projet 1</h5>
                    <p>Dans le cadre de la formation OpenClassroom, voici un site de vente et de location de chalet fictif réalisé sur WordPress</p>
                </a> 
            </div>
            </div>
            <?/*<div class="carousel-item">
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
            </div>*/?>
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
        <?php if(null !== Session::get('erreur')): ?>
            <div class="alert alert-danger text-center" role ="alert">
                <?= Session::get('erreur'); Session::forget('erreur'); ?>
            </div>
        <?php endif; ?>
        <?php if(null !== Session::get('erreur')): ?>
            <div class="alert alert-danger text-center" role ="alert">
                <?= Session::get('erreur'); Session::forget('erreur'); ?>
            </div>
        <?php endif; ?>
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