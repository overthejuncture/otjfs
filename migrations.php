<?php

include_once './helpers.php';
include_once './vendor/autoload.php';

$migration = new create_todo_table();
$migration->up();
