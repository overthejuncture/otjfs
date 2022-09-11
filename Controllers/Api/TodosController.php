<?php

namespace Controllers\Api;

use Controllers\BaseController;
use Core\Models\Todo;
use Requests\TodosRequest;

class TodosController extends BaseController
{
    public function create(TodosRequest $request)
    {
        $body = $request->get('text');
        $todo = new Todo();
        $todo->body = $body;
        $todo->done = false;
        $todo->save();
    }
}