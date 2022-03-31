<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

use Core\Requests\Request;
use Core\Routing\Route;

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
