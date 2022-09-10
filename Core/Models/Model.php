<?php

namespace Core\Models;

use Core\Database\QueryBuilder;
use Core\Database\QueryBuilderFactory;

// TODO убрать прямое использование conn
class Model
{
    protected string $tableName;
    protected array $attributes = [];
    protected string $dbConn = 'default';

    public function __construct()
    {
        if (!isset($this->tableName)) {
            $this->tableName = $this->makeTableNameFromStaticClass();
        }
    }

    private function makeTableNameFromStaticClass(): string
    {
        $array = explode('\\', static::class);
        return mb_strtolower(array_pop($array)) . 's';
    }

    public function getAll()
    {
        return $this->newBuilder()->select();
    }

    public function save()
    {
        $builder = $this->newBuilder();
        $builder->insert($this->attributes);
    }

    public function newBuilder(): QueryBuilder
    {
        $builder = new QueryBuilderFactory();
        return $builder->createBuilder($this->dbConn)->setTable($this->tableName);
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function __get($key)
    {
        return $this->attributes[$key];
    }
}
