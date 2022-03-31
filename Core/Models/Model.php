<?php

namespace Core\Models;

use Core\Database\DB;
use PDO;

class Model
{
    private string $name;
    private PDO $conn;

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
}
