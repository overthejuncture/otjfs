<?php

namespace Controllers;

use Core\Models\Model;

class TodosController
{
    public function index()
    {
        $data = Model::factory('todos')->getAll();


        return view('todos/index', ['data' => $data]);
    }
}
