<?php

namespace Core;

class Column
{
    public string $name;
    public string $type;
    public array $params;

    public function __construct(string $type, string $name, array $params)
    {
//        if (!in_array($type, static::allowedTypes)) {
//             TODO custom exception
//            throw new Exception("Type $type is not defined as column type. Try " . implode(', ', static::allowedTypes));
//        }
        $this->name = $name;
        $this->type = $type;
        $this->params = $params;
    }
}
