<?php

function getBdd() {
    $bdd = new PDO('mysql:host=localhost;dbname=databasep5;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
}

?>