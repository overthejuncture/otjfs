<?php

namespace Core\Database;

use Core\Column;

/**
 * Class for keeping operations with database.
 * Mostly or only for migrations.
 */
class Blueprint
{
    public static int $defaultStringLength = 255;
    private array $columns = [];
    private string $tableName;
    /** TODO apply modes */
    private int $mode;

    public const MODE_CREATE = 1;

    public function __construct(int $mode, string $tableName)
    {
        $this->mode = $mode;
        $this->tableName = $tableName;
    }

    /** TODO make other column types */
    public function text(string $name, int $length = null)
    {
        $length = $length ?: static::$defaultStringLength;
        $this->columns[] = Column::getInstance('text', $name, ['length' => $length]);
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function toSql()
    {
        $sql = [];
        foreach ($this->columns as $column) {
            $sql[] = MysqlSqlConstructor::columnDefinitionToSql($this->tableName, $column);
        }
        return $sql;
    }
}
