<?php

use Core\Request;
use Core\Route;

$header = getallheaders();
function dd($var, $die = true)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    if ($die)
        die();
}

require_once './vendor/autoload.php';

$req = Request::getInstance();
$route = Route::getInstance();
require_once 'routing/routes.php';
