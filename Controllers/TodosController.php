<?php

namespace Controllers;

use Core\Models\Todo;

class TodosController
{
    /**
     * @param Todo $todos
     * @return \Core\Responses\ViewResponse|\Core\Singleton
     */
    public function index(Todo $todos)
    {
        return view('todos/index', ['data' => $todos->getAll()]);
    }
}
