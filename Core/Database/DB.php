<?php

namespace Core\Database;

use Core\Database\Connection\Connection;
use Core\Database\Connection\ConnectionFactory;
use function dd;

class DB
{
    public static function getConnection(string $connection = 'default'): Connection
    {
        $fullConfig = config('db');
        if (!isset($fullConfig[$connection])) {
            throw new \Exception('No database settings for key: ' . $connection);
        }
        return (new ConnectionFactory())->createConnection($fullConfig[$connection]);
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
            dd(static::getConnection()->query($sql), false);
        }
    }

    public static function getSqlConstructor()
    {
    }
}
