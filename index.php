<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

use Core\Requests\Request;
use Core\Routing\Route;

$header = getallheaders();

require_once './vendor/autoload.php';
require_once './helpers.php';

$route = Route::getInstance(Request::capture());
require_once 'routing/routes.php';
$route->getResponse()->send();
