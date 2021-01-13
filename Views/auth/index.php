<div class="container">
    <h2 class="text-center">Inscription</h2>
    <form action="#" method="post" id="inscription">
        <?php if(isset($_SESSION['erreur'])): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= $error; unset($_SESSION['erreur']); ?>
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
            <label for="pseudonyme" class="form-label">Pseudonyme</label>
            <input class="form-control" type="text" name="pseudonyme">
        </div>
         
        <div class="form-group">
            <label for="mail" class="form-label">Adresse mail</label>
            <input class="form-control" type="text" placeholder="exemple@domaine.fr" name="mail">
        </div>
        
        <div class="form-group">
            <label for="password" class="form-label">Mot de passe</label>
            <input class="form-control" type="password" placeholder="" name="password">
        </div>

        <div class="form-group">
            <label for="password2" class="form-label">Confirmer mot de passe</label>
            <input class="form-control" type="password" placeholder="" name="password2">
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rgpd" required>
            <label class="form-check-label" for="rgpd">J'autorise ce site à conserver mes données personnelles transmises via ce formulaire. Aucun exploitation commerciale ne sera faite des données conservées.</label>
        </div>

        <div class="form-group text-center">
            <button class="btn btn-primary" type="submit" id="inscription">S'inscrire</button>
        </div>
    </form>
</div>
<hr>
