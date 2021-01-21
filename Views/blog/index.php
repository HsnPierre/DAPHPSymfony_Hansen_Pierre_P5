<div class='container' id='showPost'>

    <h2 class='text-center'>Liste des actualités</h2>

    <?php
        foreach($valeurs as $valeur){
            $nom = $user->findOneById('name', $valeur['idUser']);
            $prenom = $user->findOneById('surname', $valeur['idUser']);
            $date = date('\P\o\s\t\é \l\e d.m.y, \à H:i', strtotime($valeur['date']));
            $id = $valeur['idPost'];

            if(isset($valeur['editor']) && isset($valeur['dateEdit'])){
                $dateEdit = date('\M\i\s \à \j\o\u\r \l\e d.m.y, \à H:i', strtotime($valeur['dateEdit']));
                echo
                "
                <div id='post".$id."'>
                <p class='text-center'>".$date." (".$dateEdit.")</p>
                <div class='text-center'><a href='blog/post/".$id."'><img src='https://www.heberger-image.fr/images/2021/01/14/post53a53974587df487.jpg' alt='Post Image' border='0' /></a></div>
                <h3 class='post-title text-center'><a href='blog/post/".$id."'>".$valeur['title']."</a></h3>
                <h5 class='post-subtitle text-center'>".$valeur['description']."</h5>
                <p class='text-center'>".$prenom['surname']." ".$nom['name']." (édité par ".$valeur['editor'].")</p>
                <hr>
                "
                ;
            } else {

                echo
                "
                <div id='post".$id."'>
                <p class='text-center'>".$date."</p>
                <div class='text-center'><a href='blog/post/".$id."'><img src='https://www.heberger-image.fr/images/2021/01/14/post53a53974587df487.jpg' alt='Post Image' border='0' /></a></div>
                <h3 class='post-title text-center'><a href='blog/post/".$id."'>".$valeur['title']."</a></h3>
                <h5 class='post-subtitle text-center'>".$valeur['description']."</h5>
                <p class='text-center'>".$prenom['surname']." ".$nom['name']."</p>
                <hr>
                "
                ;
            }
        }
    ?>
</div>
