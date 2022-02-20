<?php

use Core\Route;

Route::get('/', function () {
    echo 'index route closure';
});
Route::get('/check', [Controllers\Index::class, 'check']);
