<?php

namespace Core;

/**
 * @property mixed|null $length
 */
class Column
{
    protected string $name;
    protected string $type;
    protected array $params;

    public function __construct(string $type, string $name, array $params = [])
    {
//        if (!in_array($type, static::allowedTypes)) {
//             TODO custom exception
//            throw new Exception("Type $type is not defined as column type. Try " . implode(', ', static::allowedTypes));
//        }
        $this->name = $name;
        $this->type = $type;
        $this->params = $params;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function nullable(bool $nullable = true)
    {
        $this->params['nullable'] = $nullable;
    }

    public function __get($key)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }
        return null;
    }
}
