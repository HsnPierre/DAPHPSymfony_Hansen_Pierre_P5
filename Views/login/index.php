<div class="container">
    <?php use App\Core\Session; if(Session::get('valide') !== null): ?>
    <div class="alert alert-success text-center" role="alert">
            <?= Session::get('valide'); Session::forget('valide'); ?>
    </div>
    <?php endif; ?>
    <h2 class="text-center">Se connecter</h2>
    <?php if(Session::get('erreur') !== null): ?>
    <div class="alert alert-danger text-center" role ="alert">
        <?php
            for($i = 0; $i < count(Session::get('erreur')); $i++){
        ?>
                <?= Session::get3d('erreur', $i).'<br>' ?>
        <?php
            }
            Session::forget('erreur'); 
        ?>
    </div>
    <?php endif; ?>
    <form method="post" id="connexion">
        <div class="form-group">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input class="form-control" type="text" name="pseudo">
        </div>

        <div class="form-group">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input class="form-control" type="password" placeholder="" name="mdp">
        </div>

        <div class="form-group text-center">
            <button class="btn btn-primary" type="submit" id="connexion">Se connecter</button>
        </div>
    </form>
</div>
<hr>
