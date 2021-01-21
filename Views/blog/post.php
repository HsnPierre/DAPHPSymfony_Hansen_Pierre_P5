<div class='container' id='Post'>

    <h2 class='text-center'><?= $_SESSION['postTitle'] ?></h2>
    <h4><?= $_SESSION['postDesc'] ?></h2>

    <div class='container'>
    
        <p><?= html_entity_decode($_SESSION['postContent'], ENT_HTML5, UTF-8) ?></p>

        <p>Publié par <?= $_SESSION['postAuteur'] ?> le <?= $_SESSION['postDate'] ?></p>

    </div>

    <hr>

    <div class='container' id='comment'>
    
        <h3>Commentaires:</h3>

        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['idUser'])): ?>


                <h6>Laissez un commentaire</h6>

                <?php if(isset($_SESSION['erreur'])): ?>
                    <div class="alert alert-danger text-center" role ="alert">
                        <?= $_SESSION['erreur']; unset($_SESSION['erreur']); ?>
                    </div>
                <?php endif; ?>

                <?php if(isset($_SESSION['valide'])): ?>
                    <div class="alert alert-success text-center" role ="alert">
                        <?= $_SESSION['valide']; unset($_SESSION['valide']); ?>
                    </div>
                <?php endif; ?>

            <div class='container row justify-content-start'>
                <form action="#comment" method='post' id='comments'>
                    <div>
                        <textarea name="comments" id="" cols="70" rows="3"></textarea>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="rgpd" required>
                        <label class="form-check-label" for="rgpd">J'autorise ce site à conserver mes données personnelles transmises via ce formulaire. Aucune exploitation commerciale ne sera faite des données conservées.</label>
                    </div>

                    <div>
                        <button class='btn btn-primary' type='submit' name='submit'>Envoyer</button> 
                        <form method='post'>                 
                        <button class='btn btn-secondary' type='submit' name='cancel'>Annuler</button>       
                        </form>           
                    </div>
                </form>
            </div>

        <?php else: ?>

            <p>Veuillez vous <a href='/login'>connecter</a> ou vous <a href='/auth'>inscrire</a> pour pouvoir commenter.</p>
            
        <?php endif; ?>

        <hr>
        <div class='container' id='showComment'>

            <?php
            foreach($valeurs as $valeur){
                $pseudo = $user->findOneById('username', $valeur['idUser']);
                $date = date('\(d.m.y, H:i\)', strtotime($valeur['date']));
                $idComment = $valeur['idComment'];

                if($valeur['valid'] != 0 && $valeur['idPost'] == $id){

                    echo
                    "
                    <div id='comment".$idComment."'>
                    <div><h6 id='pseudocomment'>".$pseudo['username']." <span>".$date."</span></h6></div>
                    <div id='commentaire'>
                    ".$valeur['content']."
                    </div>
                    </div>
                    <hr>
                    "
                    ;

                }
            }
            ?>

        </div>

    </div>

</div>
