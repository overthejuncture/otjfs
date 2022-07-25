<?php

$root = __DIR__;
$path = 'Core' . DIRECTORY_SEPARATOR . 'Psr4Autoloader.php';
require $root . DIRECTORY_SEPARATOR . $path;
Core\Psr4Autoloader::$config = [
    [
        'prefix'=>'Core',
        'base_path'=>'Core',
    ],
    [
        'prefix'=>'Controllers',
        'base_path'=>'Controllers',
    ],
    [
        'prefix'=> "Psr\\Container",
        'base_path' => "vendor/psr/container/src/"
    ]
];
spl_autoload_register(['Core\Psr4Autoloader', 'load']);