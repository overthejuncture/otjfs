<?php

namespace Core\Database;

use Core\Database\Connection\Connection;
use Core\Interfaces\SqlConstructorInterface;

class QueryBuilder
{
    private string $table;
    private SqlConstructorInterface $constructor;
    private Connection $conn;

    public function __construct(Connection $connection, SqlConstructorInterface $sqlConstructor)
    {
        $this->conn = $connection;
        $this->constructor = $sqlConstructor;
    }

    public function insert($values)
    {
        $sql = $this->constructor->insert($this->table, $this->parseValues($values));
        $this->conn->insert($sql);
    }

    public function select()
    {
        $sql = $this->constructor->select($this->table);
        return $this->conn->select($sql);
    }

    public function parseValues($values)
    {
        foreach ($values as $key => $value) {
            if ($value === false) {
                $values[$key] = '0';
            }
        }
        return $values;
    }

    public function setTable(string $table)
    {
        $this->table = $table;
        return $this;
    }

    public function getTable()
    {
        return $this->table;
    }
}