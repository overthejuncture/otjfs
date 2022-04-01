<?php

namespace Core\Models;

use Core\Database\DB;
use PDO;

class Model
{
    private string $name;
    private PDO $conn;
    private array $attributes = [];

    public function __construct()
    {
        if (!isset($this->name)) {
            $this->name = $modelName ?? static::makeNameFromStaticClass();
        }
        $this->conn = DB::getConnection();
    }

    private static function makeNameFromStaticClass(): string
    {
        $array = explode('\\', static::class);
        return mb_strtolower(array_pop($array)) . 's';
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * from " . $this->name);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        $query = "INSERT INTO " . $this->name . " (body) VALUES ('" . implode("','", $this->attributes) . "')";
        $stmt = $this->conn->query($query);
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }
}
