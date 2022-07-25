<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'autoload.php';

require_once './helpers.php';

use Core\Container\ServiceContainer;
use Core\Kernel;
use Core\Routing\Router;

$sc = new ServiceContainer();

$header = getallheaders();

$router = new Router('routing/routes.php');
$kernel = new Kernel($sc, $router);
$kernel->handle($request = Core\Requests\Request::capture());
