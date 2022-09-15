<?php

namespace Core\Database\Connection;

use PDO;

class Connection
{
    private $conn;

    public function __construct($connection, $host, $db, $charset, $user, $password)
    {
        $this->conn = new PDO("$connection:host=$host;dbname=$db;charset=$charset", $user, $password);
        return $this->conn;
    }

    public function insert($sql)
    {
        try {
            $statement = $this->conn->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            dd($sql, false);
            dd($e->getMessage());
        }
    }

    public function select($sql)
    {
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function query(string|array $sql)
    {
        $statement = $this->conn->prepare($sql);
        return $statement->execute();
    }
}