<?php

namespace Core;

abstract class Singleton
{
    /**
     * @var Singleton
     */
    private static $instance = [];

    /**
     * @return static|null
     */
    public static function getInstance($params = null)
    {
        $class = static::class;
        if (!isset(static::$instance[$class])) {
            if ($params !== null) {
                static::$instance[$class] = new static($params);
            } else {
                static::$instance[$class] = new static();
            }
        }
        return static::$instance[$class];
    }
}
