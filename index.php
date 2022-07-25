<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'autoload.php';

use Core\Requests\Request;
use Core\Routing\Route;
use Core\Routing\Router;

$header = getallheaders();

//require_once './vendor/autoload.php';
require_once './helpers.php';
$router = new Router('routing/routes.php');
$kernel = new \Core\Kernel($router);
$kernel->handle($request = Core\Requests\Request::capture());
