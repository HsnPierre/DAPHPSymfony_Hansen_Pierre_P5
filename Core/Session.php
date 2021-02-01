<?php
namespace App\Core;

class Session 
{
    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function put3d($key, $key2, $value)
    {
        $_SESSION[$key][$key2] = $value;
    }

    public static function get($key)
    {
        return (isset($_SESSION[$key]) ? $_SESSION[$key] : null);
    }

    public static function get3d($key, $key2)
    {
        return (isset($_SESSION[$key][$key2]) ? $_SESSION[$key][$key2] : null);
    }

    public static function forget($key)
    {
        unset($_SESSION[$key]);
    }

    public static function forget3d($key, $key2)
    {
        unset($_SESSION[$key][$key2]);
    }
}