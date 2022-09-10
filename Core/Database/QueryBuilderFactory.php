<?php

namespace Core\Database;

use Core\Database\SqlConstructors\SqlConstructorFactory;

class QueryBuilderFactory
{
    public function createBuilder(string $dbConfig = 'default')
    {
        $config = config('db')[$dbConfig];
        $sqlConst = SqlConstructorFactory::createConstructor($config['connection']);
        $conn = DB::getConnection($dbConfig);
        return new QueryBuilder($conn, $sqlConst);
    }
}