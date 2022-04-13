<?php

namespace Core\Database;

use Core\Column;

/**
 * Class for keeping commands with database.
 * Mostly or only for migrations.
 * (Right now only used for keeping columns info)
 */
class Blueprint
{
    protected static int $defaultStringLength = 255;
    protected array $columns = [];
    protected string $tableName;

    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * TODO make other column types
     */
    public function text(string $name, int $length = null)
    {
        $length = $length ?: static::$defaultStringLength;
        $this->columns[] = new Column('text', $name, ['length' => $length]);
    }

    public function getColumns(): array
    {
        return $this->columns;
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
