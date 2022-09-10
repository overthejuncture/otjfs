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
        /** @var \Core\Database\QueryBuilder $builder */
        $builder = $this->container->resolve(\Core\Database\QueryBuilder::class);
        $builder->setTable('todos');
        $builder->insert([]);
        return view('todos/index', ['data' => $todos->getAll()]);
    }
}
