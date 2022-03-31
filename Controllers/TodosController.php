<?php

namespace Controllers;

use Core\Models\Todo;

class TodosController
{
    public function index()
    {
        $model = new Todo();
//        dd($model);
        $data = $model->getAll();


        return view('todos/index', ['data' => $data]);
    }
}
