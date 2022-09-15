<?php

namespace Core\Database;

use Core\Column;
use Core\Database\SqlConstructors\MysqlSqlConstructor;

/**
 * Class for keeping commands with database.
 * Mostly or only for migrations.
 * (Right now only used for keeping columns info)
 */
class Blueprint
{
    protected static int $defaultStringLength = 255;
    /** @var array<Column> $columns */
    protected array $columns = [];
    protected string $tableName;

    public function __construct(string $tableName, \Closure $closure = null)
    {
        $this->tableName = $tableName;
        if ($closure) {
            $closure($this);
        }
    }

    /**
     * TODO make other column types
     */
    public function text(string $name, int $length = null): Column
    {
        return $this->addColumn('text', $name,
            ['length' => $length ?: static::$defaultStringLength]
        );
    }

    public function boolean(string $name): Column
    {
        return $this->addColumn('boolean', $name);
    }

    protected function addColumn(string $type, string $name, array $params = []): Column
    {
        $column = new Column($type, $name, $params);
        $this->columns[] = $column;
        return $column;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getTablename()
    {
        return $this->tableName;
    }

    public function toSql(): array
    {
        $sql = [];
        foreach ($this->columns as $column) {
            // TODO sql constructor
            $sql[] = MysqlSqlConstructor::columnDefinitionToSql($this->tableName, $column);
        }
        return $sql;
    }
}
