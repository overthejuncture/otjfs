<?php

namespace Core\Database\Connection;

class ConnectionFactory
{
    public function createConnection(array $config)
    {
        $driver = $config['connection'];

        switch ($driver) {
            case 'mysql':
                return new MysqlConnection(
                    $driver,
                    $config['host'],
                    $config['db'],
                    $config['charset'],
                    $config['user'],
                    $config['password']
                );
            default:
                throw new \Exception("No such driver");
        }
    }
}