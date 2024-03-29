<?php

use Core\Routing\Route;

Route::get('/', function () {
    echo 'index route closure';
});
Route::get('/json', [Controllers\IndexController::class, 'json']);

Route::get('/view', [Controllers\IndexController::class, 'view']);

Route::get('/todos', [Controllers\TodosController::class, 'index']);
Route::get('/todos/create', [Controllers\TodosController::class, 'create']);
Route::post('/api/todos/create', [Controllers\Api\TodosController::class, 'create']);

Route::get('/test', [Controllers\IndexController::class, 'test']);
