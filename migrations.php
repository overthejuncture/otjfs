<?php

include_once './helpers.php';
include_once './vendor/autoload.php';

/** TODO read migrations one by one */
/** TODO table for keeping migrations info */
$migration = new create_todo_table();
$migration->up();
