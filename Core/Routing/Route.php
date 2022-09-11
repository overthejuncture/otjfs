<?php

namespace Core\Routing;

use Closure;
use Core\Responses\BaseResponse;
use Core\Responses\ClosureResponse;

/**
 * Class Route
 *
 * Class-config, containing routing.
 * TODO interface
 */
class Route
{
    private static $get = [];
    private static $post = [];

    /**
     * @param $uri
     * @param array|Closure $action
     * @return void
     */
    public static function get($uri, array|Closure $action)
    {
        self::$get[$uri] = $action;
    }

    public static function post($uri, array|Closure $action)
    {
        self::$post[$uri] = $action;
    }

    public static function isControllerAction($callable): bool
    {
        return is_array($callable);
    }

    public static function getPaths()
    {
        return [
            'get' => self::$get,
            'post' => self::$post,
        ];
    }

    public static function match(string $uri, string $method)
    {
        return self::${$method}[$uri];
    }

    private static function runControllerAction($action)
    {
        $controller = static::createController($action[0]);
        return $controller->{$action[1]}();
    }

    private static function createController($controller)
    {
        return new $controller();
    }
}
