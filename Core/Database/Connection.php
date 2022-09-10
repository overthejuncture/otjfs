<?php

namespace Core\Database;

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
        $statement = $this->conn->prepare($sql);
        $statement->execute();
    }

    public function select($sql)
    {
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}