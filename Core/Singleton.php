<?php

namespace Core;

abstract class Singleton
{
    /**
     * @var Singleton
     */
    private static $instance = [];

    public function __construct() {}

    /**
     * @return static
     */
    public static function getInstance(...$params): Singleton
    {
        $class = static::class;
        if (!isset(static::$instance[$class])) {
            if ($params) {
                /**
                 * По идее должны работать зависимости конструкторов. Нужно лишь сделать функцию
                 * инициализации приложения, где инстансам будет передано то, что нужно, а потом можно
                 * будет получать их без параметров, так как они уже инициализированы.
                 */
                static::$instance[$class] = new static(...$params);
            } else {
                static::$instance[$class] = new static();
            }
        }
        return static::$instance[$class];
    }
}
