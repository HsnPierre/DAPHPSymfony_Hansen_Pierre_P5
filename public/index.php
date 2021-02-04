<?php

use App\Autoloader;
use App\Core\Main;

define('ROOT', dirname(__DIR__));
define('HOST', "http://".$_SERVER['SERVER_NAME']."/");

require_once ROOT.'/Autoloader.php';
Autoloader::register();

$app = new Main();

$app->start();
