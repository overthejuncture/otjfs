<?php

namespace Core\Database;

class SqlConstructorFactory
{
    public static function createConstructor($driver)
    {
        switch ($driver) {
            case 'mysql':
                return new MysqlSqlConstructor();
            default:
                throw new \Exception("No sql constructor for driver: $driver");
        }

    }
}