<?php

namespace Core\Database\SqlConstructors;

use Core\Column;

class MysqlSqlConstructor extends SqlConstructor
{
    public function insert($table, $values)
    {
        $sql = "insert into $table (body, done) values ('asdf', '1')";
        return $sql;
    }

    public function select(string $table, $columns = [])
    {
        // TODO
        $sql = "SELECT * FROM $table";
        return $sql;
    }

    /** TODO custom and default primary keys */
    public static function createTableSql(string $title): string
    {
        return "CREATE TABLE $title (id int NOT NULL auto_increment, CONSTRAINT {$title}_pk PRIMARY KEY (id));";
    }

    public static function columnDefinitionToSql(string $table, Column $column): string
    {
        return "ALTER TABLE $table " . static::columnToSql($column);
    }

    protected static function columnToSql(Column $column)
    {
        $sql = " ADD COLUMN " . $column->getName() . " ";
        $sql .= static::columnTypeToSqlType($column) . " ";
        $sql .= static::columnParamsToSql($column);
        return $sql;
    }

    protected static function columnTypeToSqlType(Column $column)
    {
        $method = "type" . ucfirst($column->getType());
        if (method_exists(static::class, $method)) {
            return static::$method($column);
        }
        throw new Exception("No function for column type " . $column->getType());
    }

    /**
     * @uses modifierNullable
     * @param Column $column
     * @return string
     */
    protected static function columnParamsToSql(Column $column): string
    {
        $sql = " ";
        foreach ($column->getParams() as $param => $value) {
            $method = "modifier" . ucfirst($param);
            if (method_exists(static::class, $method)) {
                $sql .= " " . static::$method($value) . " ";
            }
        }
        return $sql;
    }

    protected static function modifierNullable(bool $value): string
    {
        if ($value) {
            return "NULL";
        } else {
            return "NOT NULL";
        }
    }

    protected static function typeText(Column $column): string
    {
        return "VARCHAR(" . $column->length . ")";
    }

    protected static function typeBoolean(Column $column): string
    {
        return "TINYINT(1)";
    }

    public static function dropTableSql(string $tableName): string
    {
        return "DROP TABLE $tableName";
    }
}
