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
            $pseudo = $user->findOneById('username', $valeur['idUser']);
            $date = date('\(d.m.y, H:i\)', strtotime($valeur['date']));
            $idComment = $valeur['idComment'];

            if($valeur['valid'] == 0){
                echo
                "
                <div id='comment".esc_attr($idComment)."' class='justify-content-center row'>
                <div class='text-center'><h6 id='pseudocomment'>".esc_attr($pseudo['username'])." <span>".esc_attr($date)."</span></h6></div>
                <div class='justify-content-center row' id='commentaire'>
                <div class='col-8 text-center'>".esc_attr($valeur['content'])."</div>
                </div>
                <form method='post'>
                    <div class='text-center'>
                        <button class='btn btn-primary' type='submit' name='oui' value=".esc_attr($idComment).">Valider</button>               
                        <button class='btn btn-danger' type='submit' name='non' value=".esc_attr($idComment).">Supprimer</button>                 
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
                <div id='comment".esc_attr($idComment)."' class='justify-content-center row'>
                <div class='text-center'><h6 id='pseudocomment'>".esc_attr($pseudo['username'])." <span>".esc_attr($date)."</span></h6></div>
                <div class='justify-content-center row' id='commentaire'>
                <div class='col-8 text-center'>".esc_attr($valeur['content'])."</div>
                </div>
                <form method='post'>
                    <div class='text-center'>              
                        <button class='btn btn-danger' type='submit' name='non' value=".esc_attr($idComment).">Supprimer</button>                 
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