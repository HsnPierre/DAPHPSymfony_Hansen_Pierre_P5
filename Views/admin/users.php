<?php if(stristr($_SESSION['user']['role'], "Host") != false): ?>

<div class='container' id='showUsers'>
    <h2 class='text-center'>Liste des utilisateurs</h2>
    <h6>Rechercher un utilisateur</h6>

    <form method='post'>

        <div class='row'>
            <div class='col form-group'>
                <input class='form-control' type="text" name='username'>
            </div>
            <div class='col form-group'>
                <button class='btn btn-secondary' name='search'>Rechercher</button>
            </div>
        </div>

    </form>

    <hr>

    <h6>Afficher par</h6>
    <form method='post' class='text-center'>
      
        <button class='col-auto btn' name='username' value='ASC'>Alphabetique (⬆)</button>
        <button class='col-auto btn' name='username' value='DESC'>Alphabetique (⬇)</button>
        <button class='col-auto btn' name='date' value='ASC'>Date (⬆)</button>
        <button class='col-auto btn' name='date' value='DESC'>Date (⬇)</button>
        <button class='col-auto btn' name='role' value='ASC'>Role</button>
    
    </form>

    <hr>

    <div class='row'>
        <h5 class='col-2'>Username</h5>
        <h5 class='col-3'>Nom & prénom</h5>
        <h5 class='col-3'>Adresse mail</h5>
        <h5 class='col-2'>Role</h5>
    </div>

    <?php
    foreach($valeurs as $valeur){
        $i = 0;
        $idUser = $valeur['idUser'];

        if(stristr($valeur['role'], "Administrateur") == false){

            echo
            "
            <form method='post'>
            <div id='user".$idUser."' class='row'>
                <p class='col-2'>".$valeur['username']."</p>
                <p class='col-3'>".$valeur['name']." ".$valeur['surname']."</p>
                <p class='col-3'>".$valeur['email']."</p>
                <p class='col-2'>Utilisateur</p>
                <button class='col-2 btn' name='setadmin' value='$idUser'>Mettre admin</button>
            </div>
            </form>
            <hr>
            "
            ;
            $i++;

        } elseif(stristr($valeur['role'], "Host") == false) {
            echo
            "
            <form method='post'>
            <div id='user".$idUser."' class='row'>
                <p class='col-2'>".$valeur['username']."</p>
                <p class='col-3'>".$valeur['name']." ".$valeur['surname']."</p>
                <p class='col-3'>".$valeur['email']."</p>
                <p class='col-2'>Administrateur</p>
                <button class='col-2 btn' name='unsetadmin' value='$idUser'>Retirer admin</button>
            </div>
            </form>
            <hr>
            "
            ;
            $i++;
        } 
    }
    if($i == 0) {
        echo "<div class='alert alert-danger text-center' role='alert'>Aucun utilisateur n'a été trouvé.</div>";
    }
    ?>

    
</div>
<?php endif; ?>