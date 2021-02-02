<?php
namespace App\Core;

class File 
{
    public static function put($key, $value)
    {
        $_FILES[$key] = $value;
    }

    public static function put3d($key, $key2, $value)
    {
        $_FILES[$key][$key2] = $value;
    }

    public static function get($key)
    {
        return (isset($_FILES[$key]) ? $_FILES[$key] : null);
    }

    public static function get3d($key, $key2)
    {
        return (isset($_FILES[$key][$key2]) ? $_FILES[$key][$key2] : null);
    }

    public static function forget($key)
    {
        unset($_FILES[$key]);
    }

    public static function forget3d($key, $key2)
    {
        unset($_FILES[$key][$key2]);
    }
}