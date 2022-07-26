<?php

use Core\Migration;

include_once 'helpers.php';
include_once 'autoload.php';
array_shift($argv);
/** TODO table for keeping migrations info */
// TODO commands
// TODO sort the migrations

$params = $argv;
$path = 'database/migrations';
$files = array_values(array_diff(scandir($path), array('..', '.', '.gitkeep')));
$migrations = [];
foreach ($files as $title) {
    include_once $path . DIRECTORY_SEPARATOR . $title;
    $className = mb_substr($title, 0, -4);
    $className = implode('_', array_slice(explode('_', $className), 1));
    $migrations[] = new $className();
}
/** @var array<Migration> $migrations */
foreach ($migrations as $migration) {
    $migration->up();
}

//if (!empty($params[0]) && $params[0] === '--down') {
//    $migration->down();
//    return;
//}
