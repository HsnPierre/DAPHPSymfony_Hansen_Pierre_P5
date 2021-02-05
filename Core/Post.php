<?php
namespace App\Core;

class Post
{

    public static function raw()
    {
        return null != filter_input_array(INPUT_POST) ? filter_input_array(INPUT_POST) : null;
    }

    public static function get($key)
    {
        return null != filter_input_array(INPUT_POST, $key) ? filter_input_array(INPUT_POST, $key) : null;
    }

}