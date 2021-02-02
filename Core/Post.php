<?php
namespace App\Core;

class Post
{
    public static function put($key, $value)
    {
        $_POST[$key] = $value;
    }

    public static function raw()
    {
        return (isset($_POST) ? $_POST : null);
    }

    public static function get($key)
    {
        return (isset($_POST[$key]) ? $_POST[$key] : null);
    }

}