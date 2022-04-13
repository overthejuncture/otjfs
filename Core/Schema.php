<?php

namespace Core;

use Core\Database\Blueprint;
use Core\Database\DB;
use Core\Database\MysqlSqlConstructor;
use Exception;

class Schema
{
    public function __construct()
    {
    }

    /**
     * @param string $tableName For which table return the blueprint
     * @param callable $callback
     * @throws Exception
     */
    public static function create(string $tableName, callable $callback)
    {
        $blueprint = new Blueprint($tableName);
        $callback($blueprint);
        /** TODO depend on blueprints mode */
        $createTableSql = MysqlSqlConstructor::createTableSql($tableName);
        DB::runSql([$createTableSql, ...$blueprint->toSql()]);
    }

    public static function drop(string $tableName)
    {
        $sql = MysqlSqlConstructor::dropTableSql($tableName);
        DB::runSql([$sql]);
    }
}
