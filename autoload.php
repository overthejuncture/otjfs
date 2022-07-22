<?php

$root = __DIR__;
$path = 'Core' . DIRECTORY_SEPARATOR . 'Psr4Autoloader.php';
require $root . DIRECTORY_SEPARATOR . $path;
Core\Psr4Autoloader::$config = [
    [
        'prefix'=>'Core',
        'base_path'=>'Core',
    ],
];
spl_autoload_register(['Core\Psr4Autoloader', 'load']);