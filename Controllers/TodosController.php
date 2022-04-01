<?php

namespace Controllers;

use Core\Models\Todo;

class TodosController
{
    public function index()
    {
        $todos = new Todo();
        return view('todos/index', ['data' => $todos->getAll()]);
    }
}
