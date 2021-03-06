<?php use App\Core\Session; $role = json_decode(Session::get3d('user', 'role')); if(in_array('Host', $role)): ?>

<div class='container' id='showUsers'>
    <h2 class='text-center'>Liste des utilisateurs</h2>
    <div class='text-center'>
        <h6>Rechercher un utilisateur</h6>

        <form method='post'>

            <div class='justify-content-center row'>
                <div class='col-8 form-group'>
                    <input class='form-control' type="text" name='username'>
                </div>
                <div class='form-group'>
                    <button class='btn btn-secondary' name='search'>Rechercher</button>
                </div>
            </div>

        </form>
    </div>

    <hr>

    <h5 class='text-center'>AFFICHER PAR</h5>
    <form method='post' class='text-center'>
      
        <h6><button class='col-auto btn' name='username' value='ASC'>▲</button>ALPHABETIQUE<button class='col-auto btn' name='username' value='DESC'>▼</button>
        <button class='col-auto btn' name='date' value='ASC'>▲</button>DATE<button class='col-auto btn' name='date' value='DESC'>▼</button>
        <button class='col-auto btn' name='role' value='ASC'>▲</button>ROLE<button class='col-auto btn' name='role' value='DESC'>▼</button></h6>
    
    </form>

    <hr>

    <div class='row'>
        <h5 class='col-2'>Username</h5>
        <h5 class='col-3'>Nom & prénom</h5>
        <h5 class='col-3'>Adresse mail</h5>
        <h5 class='col-2'>Role</h5>
    </div>

    <?php
    $i = 0;
    foreach($valeurs as $valeur){
        $idUser = $valeur['idUser'];

        if(!in_array('Administrateur', json_decode($valeur['role']))){
    ?>
            <form method='post'>
            <div id='user<?= strip_tags($idUser) ?>' class='d-flex align-items-center'>
                <p class='col-2'><?= strip_tags($valeur['username']) ?></p>
                <p class='col-3'><?= strip_tags($valeur['name']) ?> <?= strip_tags($valeur['surname']) ?></p>
                <p class='col-3'><?= strip_tags($valeur['email']) ?></p>
                <p class='col-2'>Utilisateur</p>
                <button class='col-2 btn' name='setadmin' value=<?= strip_tags($idUser) ?>>Promouvoir</button>
            </div>
            </form>
            <hr>
    <?php
            $i++;

        } elseif(!in_array('Host', json_decode($valeur['role']))) {
    ?>
            <form method='post'>
            <div id='user<?= strip_tags($idUser) ?>' class='d-flex align-items-center p-2 bg-secondary text-light'>
                <p class='col-2'><?= strip_tags($valeur['username']) ?></p>
                <p class='col-3'><?= strip_tags($valeur['name']) ?> <?= strip_tags($valeur['surname']) ?></p>
                <p class='col-3'><?= strip_tags($valeur['email']) ?></p>
                <p class='col-2'>Administrateur</p>
                <button class='col-2 btn btn-light' name='unsetadmin' value=<?= strip_tags($idUser) ?>>Destituer</button>
            </div>
            </form>
            <hr>
    <?php
            ;
            $i++;
        } 
    }
    if($i == 0) {
    ?>
        <div class='alert alert-danger text-center' role='alert'>Aucun utilisateur n'a été trouvé.</div>
    <?php
    }
    ?>

    
</div>
<?php endif; ?>