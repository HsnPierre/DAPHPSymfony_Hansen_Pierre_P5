<?php use App\Core\Session; $role = json_decode(Session::get3d('user', 'role')); if(in_array('Administrateur', $role)): ?>

<div class='container' id='showComment'>

    <h2 class='text-center'>Commentaires</h2>

    <hr>
    <h5 class='text-center'>AFFICHER PAR</h5>
    <form method='post' class='text-center'>
      
        <button class='col-4 btn' name='valid'>Commentaires publiés</button>
        <button class='col-4 btn' name='novalid'>Commentaires à valider</button>
    
    </form>

    <hr>

    <?php
        $i = 0;

        foreach($valeurs as $valeur){
            $date = date('\(d.m.y, H:i\)', strtotime($valeur['date']));
            $idComment = $valeur['idComment'];

            if($valeur['valid'] == 0){
    ?>
    <div id='comment<?= strip_tags($idComment) ?>' class='justify-content-center row'>
        <div class='text-center'><h6 id='pseudocomment'><?= strip_tags($pseudo[$i]['username']) ?> <span><?= strip_tags($date) ?></span></h6></div>
        <div class='justify-content-center row' id='commentaire'>
            <div class='col-8 text-center'><?= strip_tags($valeur['content']) ?></div>
        </div>
        <form method='post'>
            <div class='text-center'>
                <button class='btn btn-primary' type='submit' name='oui' value=<?= strip_tags($idComment) ?>>Valider</button>               
                <button class='btn btn-danger' type='submit' name='non' value=<?= strip_tags($idComment) ?>>Supprimer</button>                 
            </div>
        </form>
    </div>
    <hr>
    <?php $i++; 
            } else {
    ?>
    <div id='comment<?= strip_tags($idComment) ?>' class='justify-content-center row'>
        <div class='text-center'><h6 id='pseudocomment'><?= strip_tags($pseudo[$i]['username']) ?> <span><?= strip_tags($date) ?></span></h6></div>
        <div class='justify-content-center row' id='commentaire'>
            <div class='col-8 text-center'><?= strip_tags($valeur['content']) ?></div>
        </div>
        <form method='post'>
            <div class='text-center'>              
                <button class='btn btn-danger' type='submit' name='non' value=<?= strip_tags($idComment) ?>>Supprimer</button>                 
            </div>
        </form>
    </div>
    <hr>
    <?php
        $i++;
            }
        }
        if($i == 0){
    ?>
            <div class='alert alert-secondary text-center' role='alert'>Aucun commentaire disponible.</div>
    <?php
        }
    ?>
</div>
<?php endif; ?>