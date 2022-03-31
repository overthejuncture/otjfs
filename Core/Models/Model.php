<?php

namespace Core\Models;

use Core\Database\DB;
use PDO;

class Model
{
    public string $name;
    public PDO $conn;

    public function __construct($modelName)
    {
        $this->name = $modelName;
        $this->conn = DB::getConnection();
    }

    public static function factory($modelName): Model
    {
        return new static($modelName);
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * from " . $this->name);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
