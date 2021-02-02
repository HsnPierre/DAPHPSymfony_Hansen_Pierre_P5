<?php
namespace App\Core;

class Fonction
{
    public static function header(string $location)
    {
        header("'Location : /".$location."'");
    }

    public static function exit()
    {
        exit;
    }

}