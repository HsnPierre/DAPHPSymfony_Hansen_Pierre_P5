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
                <div id='post".esc_attr($id)."'>
                <p class='text-center'>".esc_attr($date)." (".esc_attr($dateEdit).")</p>
                <div class='text-center'><a href='blog/post/".esc_attr($id)."'><img src='https://www.heberger-image.fr/images/2021/01/14/post53a53974587df487.jpg' alt='Post Image' border='0' /></a></div>
                <h3 class='post-title text-center'><a href='blog/post/".esc_attr($id)."'>".esc_attr($valeur['title'])."</a></h3>
                <h5 class='post-subtitle text-center'>".esc_attr($valeur['description'])."</h5>
                <p class='text-center'>".esc_attr($prenom['surname'])." ".esc_attr($nom['name'])." (édité par ".esc_attr($valeur['editor']).")</p>
                <hr>
                "
                ;
            } else {

                echo
                "
                <div id='post".esc_attr($id)."'>
                <p class='text-center'>".esc_attr($date)."</p>
                <div class='text-center'><a href='blog/post/".esc_attr($id)."'><img src='https://www.heberger-image.fr/images/2021/01/14/post53a53974587df487.jpg' alt='Post Image' border='0' /></a></div>
                <h3 class='post-title text-center'><a href='blog/post/".strip_tages($id)."'>".esc_attr($valeur['title'])."</a></h3>
                <h5 class='post-subtitle text-center'>".esc_attr($valeur['description'])."</h5>
                <p class='text-center'>".esc_attr($prenom['surname'])." ".esc_attr($nom['name'])."</p>
                <hr>
                "
                ;
            }
        }
    ?>
</div>
