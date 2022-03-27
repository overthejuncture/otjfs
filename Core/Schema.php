<?php

namespace Core;

class Schema
{
    public function __construct()
    {
    }

    /**
     * @param string $tableName For which table return the blueprint
     * @param callable $callback
     */
    public static function create(string $tableName, callable $callback)
    {
        $blueprint = new Blueprint(Blueprint::MODE_CREATE, $tableName);
        $callback($blueprint);
        /** TODO depend on blueprints mode */
        $createTableSql = MysqlSqlConstructor::createTableSql($tableName);
        DB::runSql([$createTableSql, ...$blueprint->toSql()]);
    }
}
