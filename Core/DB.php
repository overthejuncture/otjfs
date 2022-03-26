<?php

namespace Core;

use PDO;

class DB
{
    /* TODO what if multiple databases */
    private static PDO $pdo;

    public static function getConnection(): PDO
    {
        if (!isset(static::$pdo)) {
            static::$pdo = new PDO('mysql:host=otj_mysql;dbname=otjfs;charset=utf8mb4', 'root', 'secret');
        }
        return static::$pdo;
    }

    public static function runSql($sql)
    {
        if (is_array($sql))
            static::runSqlArray($sql);

    }

    private static function runSqlArray(array $sqlArray)
    {
        foreach ($sqlArray as $sql) {
            static::$pdo->query($sql);
        }
    }
}
