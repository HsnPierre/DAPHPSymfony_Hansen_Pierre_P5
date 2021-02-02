<?php
namespace App\Core;

class Fonction
{
    public static function header(string $location)
    {
        return header("'Location : /".$location."'");
    }

}