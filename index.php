<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'autoload.php';

require_once './helpers.php';

use Core\Application;
use Core\Kernel;
use Core\Requests\Request;

$app = new Application();

/** @var Kernel $kernel */
$kernel = $app->resolve(Kernel::class);
$kernel->handle($request = new Request());
