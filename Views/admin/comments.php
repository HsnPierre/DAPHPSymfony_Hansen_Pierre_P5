<?php if(stristr($_SESSION['user']['role'], "Administrateur") != false): ?>

<div class='container' id='showComment'>

    <h2 class='text-center'>Commentaires</h2>

    <h6>Afficher par</h6>
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
                <div id='comment".$idComment."'>
                <div><h6 id='pseudocomment'>".$pseudo['username']." <span>".$date."</span></h6></div>
                <div id='commentaire'>
                ".$valeur['content']."
                </div>
                <form method='post'>
                    <div>
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
                <div id='comment".$idComment."'>
                <div><h6 id='pseudocomment'>".$pseudo['username']." <span>".$date."</span></h6></div>
                <div id='commentaire'>
                ".$valeur['content']."
                </div>
                <form method='post'>
                    <div>              
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