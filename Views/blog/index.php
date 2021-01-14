<div class='container' id='showPost'>

    <h2 class='text-center'>Liste des annonces</h2>

    <?php
    $valeurs = $_SESSION['content'];
    for($i = 0; $i < count($valeurs); $i++){
        echo $valeurs[$i];
    }
    ?>
</div>
