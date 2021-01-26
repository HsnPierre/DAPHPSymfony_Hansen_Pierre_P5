<?php if(stristr($_SESSION['user']['role'], "Administrateur") != false): ?>

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
            $pseudo = $user->findOneById('username', $valeur['idUser']);
            $date = date('\(d.m.y, H:i\)', strtotime($valeur['date']));
            $idComment = $valeur['idComment'];

            if($valeur['valid'] == 0){
                echo
                "
                <div id='comment".$idComment."' class='justify-content-center row'>
                <div class='text-center'><h6 id='pseudocomment'>".$pseudo['username']." <span>".$date."</span></h6></div>
                <div class='justify-content-center row' id='commentaire'>
                <div class='col-8 text-center'>".$valeur['content']."</div>
                </div>
                <form method='post'>
                    <div class='text-center'>
                        <button class='btn btn-primary' type='submit' name='oui' value='$idComment'>Valider</button>               
                        <button class='btn btn-danger' type='submit' name='non' value='$idComment'>Supprimer</button>                 
                    </div>
                </form>
                </div>
                <hr>
                "
                ;
                $i++;
            } else {
                echo
                "
                <div id='comment".$idComment."' class='justify-content-center row'>
                <div class='text-center'><h6 id='pseudocomment'>".$pseudo['username']." <span>".$date."</span></h6></div>
                <div class='justify-content-center row' id='commentaire'>
                <div class='col-8 text-center'>".$valeur['content']."</div>
                </div>
                <form method='post'>
                    <div class='text-center'>              
                        <button class='btn btn-danger' type='submit' name='non' value='$idComment'>Supprimer</button>                 
                    </div>
                </form>
                </div>
                <hr>
                "
                ;
                $i++;
            }
        }
        if($i == 0){
            echo "<div class='alert alert-secondary text-center' role='alert'>Aucun commentaire disponible.</div>";
        }
    ?>
</div>
<?php endif; ?>