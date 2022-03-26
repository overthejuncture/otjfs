<?php

namespace Core;

use Exception;

class Column extends Singleton
{
    private const allowedTypes = [
        'text'
    ];

    public string $name;
    public string $type;
    public array $params;

    /**
     * @throws Exception
     */
    public function __construct(string $type, string $name, $params)
    {
        parent::__construct();
        if (!in_array($type, static::allowedTypes)) {
            throw new Exception("Type $type is not defined as column type. Try " . implode(', ', static::allowedTypes));
        }
        $this->name = $name;
        $this->type = $type;
        $this->params = $params;
    }
}
