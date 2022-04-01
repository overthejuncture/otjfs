<?php

namespace Core\Database;

use PDO;
use function dd;

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

    /**
     * @throws \Exception
     */
    public static function runSql($sql)
    {
        if (is_array($sql)) {
            static::runSqlArray($sql);
        } else {
            /** TODO make implementation for running strings */
            throw new \Exception('No sql string query implementation');
        }
    }

    private static function runSqlArray(array $sqlArray)
    {
        foreach ($sqlArray as $sql) {
            dd(static::$pdo->query($sql), false);
        }
    }
}