<?php

namespace Controllers;

use Core\Models\Todo;
use Core\Responses\ViewResponse;
use Core\Singleton;

class TodosController extends BaseController
{
    /**
     * @param Todo $todos
     * @return Singleton|ViewResponse
     */
    public function index(Todo $todos): \Core\Singleton|\Core\Responses\ViewResponse
    {
        $todo = new Todo();
        $todo->body = 'asdf';
        $todo->done = '1';
        $todo->save();
        return view('todos/index', ['data' => $todos->getAll()]);
    }
}
