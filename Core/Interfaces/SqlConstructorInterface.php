<?php

namespace Core\Interfaces;

interface SqlConstructorInterface
{
    public function insert($table, $values);

    public function select(string $table, $columns = []);
}