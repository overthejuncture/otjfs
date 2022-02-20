<?php

namespace Core;

use Closure;
use Exception;
use function dd;

class Route extends Singleton
{
    public function __construct()
    {
    }

    /**
     * @param $uri
     * @param Closure|array $action
     * @return void
     * @throws Exception
     */
    public static function get($uri, $action)
    {
        if (Request::getInstance()->getMethod() !== 'get' || Request::getInstance()->getUri() !== $uri) {
            return;
        }
        if (!is_callable($action) && !(is_array($action) && count($action) === 2)) {
            throw new Exception('action is not correct');
        }
        if (is_callable($action)) {
            $action();
            return;
        }
        static::triggerControllerAction($action);
    }

    private static function triggerControllerAction(array $action)
    {
        $controllerClass = $action[0];
        dd($controllerClass);
        $controllerMethod = $action[1];
        $controller = new $controllerClass();
        $controller->$controllerMethod();
    }
}
