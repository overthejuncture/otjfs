<?php

namespace Core\Database;

use Core\Interfaces\SqlConstructorInterface;

class QueryBuilder
{
    private string $table;
    private SqlConstructorInterface $constructor;

    public function __construct(SqlConstructorInterface $sqlConstructor)
    {
        $this->constructor = $sqlConstructor;
    }

    public function insert($values)
    {
        $sql = $this->constructor->insert($this->table, $values);
        $conn = DB::getConnection();
        $conn->insert($sql);
    }

    public function setTable(string $table)
    {
        $this->table = $table;
    }

    public function getTable()
    {
        return $this->table;
    }
}