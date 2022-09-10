<?php

namespace Core\Database;

use function dd;

class DB
{
    public static function getConnection()
    {
        $config = config('db');
        $conn = new ConnectionFactory();
        return $conn->createConnection($config);
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
