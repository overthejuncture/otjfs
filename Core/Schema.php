<?php

namespace Core;

use Core\Database\Blueprint;
use Core\Database\Connection\Connection;
use Core\Database\Connection\ConnectionFactory;
use Core\Database\DB;
use Core\Database\SqlConstructors\MysqlSqlConstructor;
use Core\Database\SqlConstructors\SqlConstructor;
use Core\Database\SqlConstructors\SqlConstructorFactory;
use Exception;

class Schema
{
    protected SqlConstructor $constructor;
    private Connection $connection;
    private Blueprint $blueprint;

    public function __construct(Blueprint $blueprint, SqlConstructor $sqlConstructor, Connection $connection)
    {
        $this->blueprint = $blueprint;
        $this->constructor = $sqlConstructor;
        $this->connection = $connection;
    }

    /**
     * @param string $tableName For which table return the blueprint
     * @param callable $callback
     * @param string $db
     * @throws Exception
     */
    public static function create(string $tableName, callable $callback, string $db = 'default')
    {
        $config = config('db')[$db];
        $schema = new static(
            new Blueprint($tableName, $callback),
            (new SqlConstructorFactory())->createConstructor($config['connection']),
            (new ConnectionFactory())->createConnection($config)
        );
        $schema->_create();
    }

    private function _create(): void
    {
        $sqlArray = array_merge(
            [$this->constructor->createTableSql($this->blueprint->getTablename())],
            $this->blueprint->toSql()
        );
        foreach ($sqlArray as $sql) {
            $this->connection->query($sql);
        }
    }

    public static function drop(string $tableName)
    {
        $sql = MysqlSqlConstructor::dropTableSql($tableName);
        DB::runSql([$sql]);
    }

    public static function table(string $tableName, callable $callback)
    {
        $blueprint = new Blueprint($tableName, $callback);
        DB::runSql([...$blueprint->toSql()]);
    }
}
