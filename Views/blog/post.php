<div class='container' id='Post'>

    <h2 class='text-center'><?php use App\Core\Session; echo Session::get('postTitle') ?></h2>
    <h4><?= Session::get('postDesc') ?></h2>

    <div class='container'>
    
        <p><?= html_entity_decode(Session::get('postContent'), ENT_HTML5, UTF-8) ?></p>

        <p>Publié par <?= Session::get('postAuteur') ?> le <?= Session::get('postDate') ?></p>

    </div>

    <hr>

    <div class='container' id='comment'>
    
        <h3>Commentaires:</h3>

        <?php if(Session::get3d('user', 'idUser')): ?>


                <h6>Laissez un commentaire</h6>

                <?php if(Session::get('erreur') !== null): ?>
                    <div class="alert alert-danger text-center" role ="alert">
                        <?= Session::get('erreur'); Session::forget('erreur'); ?>
                    </div>
                <?php endif; ?>

                <?php if(Session::get('valide') !== null): ?>
                    <div class="alert alert-success text-center" role ="alert">
                        <?= Session::get('valide'); Session::forget('valide'); ?>
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
                    <div id='comment".esc_attr($idComment)."'>
                    <div><h6 id='pseudocomment'>".esc_attr($pseudo['username'])." <span>".esc_attr($date)."</span></h6></div>
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
