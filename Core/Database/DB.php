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
        $config = config('db');
        if (!isset(static::$pdo)) {
            static::$pdo = new PDO("{$config['connection']}:host={$config['host']};dbname={$config['db']};charset=utf8mb4", $config['user'], $config['password']);
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

    public static function getSqlConstructor()
    {
    }
}
