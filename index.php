<?php 

require('controller/controller.php');

$url = '';

if(isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);
}

if($url == '' || $url[0] == 'accueil' ) {
    index();
} elseif($url[0] == 'blog') {
    blog();
} elseif($url[0] == 'contact') {
    contact();   
} elseif($url[0] == 'authentification') {
    auth();
} 
else {
    error();
}

?>