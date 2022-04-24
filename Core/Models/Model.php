<?php

namespace Core\Models;

use Core\Database\DB;
use PDO;

class Model
{
    protected string $tableName;
    protected PDO $conn;
    protected array $attributes = [];

    public function __construct($tableName = null)
    {
        if (!isset($this->tableName)) {
            $this->tableName = $tableName ?? static::makeTableNameFromStaticClass();
        }
        $this->conn = DB::getConnection();
    }

    private static function makeTableNameFromStaticClass(): string
    {
        $array = explode('\\', static::class);
        return mb_strtolower(array_pop($array)) . 's';
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * from " . $this->tableName);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        $query = "INSERT INTO " . $this->tableName . " (body) VALUES ('" . implode("','", $this->attributes) . "')";
        $stmt = $this->conn->query($query);
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
