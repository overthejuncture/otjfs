<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'autoload.php';

require_once './helpers.php';

use Core\Application;
use Core\Kernel;
use Core\Requests\GlobalRequest;

$app = new Application();

$request = new GlobalRequest();
$app->instance(GlobalRequest::class, $request);

/** @var Kernel $kernel */
$kernel = $app->resolve(Kernel::class);
$kernel->handle($request);
