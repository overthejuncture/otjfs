<?php

namespace Core\Interfaces;

interface SqlConstructorInterface
{
    public function insert($table, $data);

    public function select(string $table, $columns = []);
}