<?php

use Core\Request;
use Core\Route;

$header = getallheaders();

require_once './vendor/autoload.php';
require_once './helpers.php';

initApp();

$req = Request::getInstance();
$route = Route::getInstance();
require_once 'routing/routes.php';
$route->getResponse()->send();

function initApp()
{
    $request = Request::getInstance();
    Route::getInstance($request);
}
