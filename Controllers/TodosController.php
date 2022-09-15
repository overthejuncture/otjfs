<?php

namespace Controllers;

use Core\Models\Todo;
use Core\Responses\ViewResponse;

class TodosController extends BaseController
{
    /**
     * @param Todo $todos
     * @return ViewResponse
     */
    public function index(Todo $todos): ViewResponse
    {
        return view('todos/index', ['data' => $todos->getAll()]);
    }

    public function create()
    {
        return view('todos/create');
    }
}
