<?php

use Core\Routing\Route;

Route::get('/', function () {
    echo 'index route closure';
});
Route::get('/json', [Controllers\Index::class, 'json']);

Route::get('/view', [Controllers\Index::class, 'view']);

Route::get('/todos', [Controllers\TodosController::class, 'index']);
