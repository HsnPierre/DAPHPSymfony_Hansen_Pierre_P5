<?php use App\Core\Session; $role = json_decode(Session::get3d('user', 'role')); if(in_array('Administrateur', $role)): ?>

<?php if((!isset($_POST['edit']) && !isset($_SESSION['edit'])) && (!isset($_POST['add']) && !isset($_SESSION['add']))): ?>

<div class='container' id='showPost'>

    <h2 class='text-center'>Liste des annonces postées</h2>

    <hr>

    <h5 class='text-center'>AFFICHER PAR</h5>
    <form method='post' class='text-center'>
      
        <h6><button class='col-auto btn' name='title' value='ASC'>▲</button>TITRE<button class='col-auto btn' name='title' value='DESC'>▼</button>
        <button class='col-auto btn' name='date' value='ASC'>▲</button>DATE<button class='col-auto btn' name='date' value='DESC'>▼</button>
        <button class='col-auto btn' name='idUser' value='ASC'>▲</button>AUTEUR<button class='col-auto btn' name='idUser' value='DESC'>▼</button></h6>
    
    </form>

    <?php if(Session::get('valide') !== null): ?>
        <div class="alert alert-success text-center" role="alert">
            <?= Session::get('valide'); Session::forget('valide'); ?>
        </div>
    <?php endif; ?>

    <hr>

    <form action=' ' method='post' id='add' class='text-center'>
        <button class='btn btn-primary' name='add'>Ajouter</button>
    </form>

    <hr>

    <?php
        foreach($valeurs as $valeur){
            $nom = $user->findOneById('name', $valeur['idUser']);
            $prenom = $user->findOneById('surname', $valeur['idUser']);
            $date = date('\P\o\s\t\é \l\e d.m.y, \à H:i', strtotime($valeur['date']));
            $id = $valeur['idPost'];

            if(isset($valeur['editor']) && isset($valeur['dateEdit'])){
                
                $dateEdit = date('\M\i\s \à \j\o\u\r \l\e d.m.y, \à H:i', strtotime($valeur['dateEdit']));
                
                echo
                "
                <div id='post".esc_attr($id)."'>
                <p>".esc_attr($date)." (".esc_attr($dateEdit).")</p>
                <h3 class='post-title text-center'>".esc_attr($valeur['title'])."</h3>
                <h5 class='post-subtitle'>".esc_attr($valeur['description'])."</h5>
                ".html_entity_decode($valeur['content'], ENT_HTML5, UTF-8)."
                <p>".esc_attr($prenom['surname'])." ".esc_attr($nom['name'])." (édité par ".esc_attr($valeur['editor']).")</p>
                    <div>
                        <form action=' ' method='post' id='delete' class='text-center'>
                            <div class='form-check col'>
                                <input class='form-check-input' type='checkbox' id='delete' required>
                                <label class='form-check-label' for='delete'>Cocher cette case pour supprimer l'article</label>
                            </div>
                            <button class='btn btn-danger col-3' name='delete' value=".esc_attr($id).">Supprimer</button>
                        </form>
                    </div><br>
                    <form action=' ' method='post' id='edit' class='text-center'>
                        <button class='btn btn-primary col-3' name='edit' value=".esc_attr($id).">Editer</button>
                    </form>
                </div>
                <hr>
                "
                ;
            } else {

                echo
                "
                <div id='post".esc_attr($id)."'>
                <p>".esc_attr($date)."</p>
                <h3 class='post-title text-center'>".esc_attr($valeur['title'])."</h3>
                <h5 class='post-subtitle'>".esc_attr($valeur['description'])."</h5>
                ".html_entity_decode($valeur['content'], ENT_HTML5, UTF-8)."
                <p>".esc_attr($prenom['surname'])." ".esc_attr($nom['name'])."</p>
                    <div class=''>
                        <form action=' ' method='post' id='delete' class='text-center'>
                            <div class='form-check col'>
                                <input class='form-check-input' type='checkbox' id='delete' required>
                                <label class='form-check-label' for='delete'>Cocher cette case pour supprimer l'article</label>
                            </div>
                            <button class='btn btn-danger col-3' name='delete' value=".esc_attr($id).">Supprimer</button>
                        </form>
                    </div><br>
                    <form action=' ' method='post' id='edit' class='text-center'>
                        <button class='btn btn-primary col-3' name='edit' value=".esc_attr($id).">Editer</button>
                    </form>
                </div>
                <hr>
                "
                ;
            }
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

        <?php if(Session::get('erreur') !== null): ?>
            <div class="alert alert-danger text-center" role ="alert">
                <?php
                    for($i = 0; $i < count(Session::get('erreur')); $i++){
                        echo Session::get3d('erreur', $i).'<br>';
                    }
                    Session::forget('erreur'); 
                ?>
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

        <?php if(Session::get('erreur') !== null): ?>
            <div class="alert alert-danger text-center" role ="alert">
                <?php
                    for($i = 0; $i < count(Session::get('erreur')); $i++){
                        echo Session::get('erreur', $i).'<br>';
                    }
                    Session::forget('erreur'); 
                ?>
            </div>
        <?php endif; ?>

        <div class="form-group col">
            <label for="titre" class="form-label">Titre</label>
            <input class="form-control" type="text" name="titre" value="<?= Session::get('titre') ?>">
        </div>
            
        <div class="form-group col">
            <label for="chapo" class="form-label">Chapô</label>
            <input class="form-control" type="text" name="chapo" value="<?= Session::get('chapo') ?>">
        </div>
        
        <div class="form-group col">
            <label for="contenu" class="form-label">Contenu</label>
            <textarea class="form-control" name="contenu"><?= Session::get('contenu') ?></textarea>
        </div>

        <div class="form-group text-center">
            <button class="btn btn-primary" type="submit" name="updatePost">Modifier</button>
        </div>

    </form>

</div>

<?php endif; ?>
<?php endif; ?>