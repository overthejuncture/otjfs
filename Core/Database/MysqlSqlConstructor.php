<?php

namespace Core\Database;

use Core\Column;

class MysqlSqlConstructor extends SqlConstructor
{
    static array $typesOfColumns = [
        'text' => 'VARCHAR(%s)'
    ];

    /** TODO custom and default primary keys */
    public static function createTableSql(string $title): string
    {
        return "CREATE TABLE $title (id int NOT NULL auto_increment, CONSTRAINT {$title}_pk PRIMARY KEY (id));";
    }

    public static function columnDefinitionToSql(string $table, Column $column): string
    {
        return "ALTER TABLE $table ADD COLUMN $column->name " . sprintf(static::$typesOfColumns[$column->type], $column->params['length']) . ';';
    }

    public static function dropTableSql(string $tableName): string
    {
        return "DROP TABLE $tableName";
    }
}
