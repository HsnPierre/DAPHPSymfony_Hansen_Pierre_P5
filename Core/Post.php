<?php
namespace App\Core;

class Post
{
    public static function put($key, $value)
    {
        $_POST[$key] = $value;
    }

    public static function get($key)
    {
        return (isset($_POST[$key]) ? $_POST[$key] : null);
    }

    public static function forget($key)
    {
        unset($_SESSION[$key]);
    }
}