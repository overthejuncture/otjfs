<?php

namespace Core\Routing;

use Closure;
use Core\Requests\Request;
use Core\Responses\BaseResponse;
use Core\Responses\ClosureResponse;
use Core\Singleton;
use Exception;

class Route extends Singleton
{
    /**
     * @var BaseResponse данные, которые возвращает контроллер или коллбэк
     */
    protected $response;
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
    }

    /**
     * @param $uri
     * @param Closure|array $action
     * @return void
     * @throws Exception
     */
    public static function get($uri, $action)
    {
        /**
         *TODO чтобы после срабатывания какого то пути другие не рассматривались,
         * переделать на считывание файла с путями
         */
        if (isset(static::getInstance()->response))
            return;

        if (static::getInstance()->request->getMethod() !== 'get' || static::getInstance()->request->getUri() !== $uri)
            return;

        if (!is_callable($action))
            throw new Exception('Action should be callable');

        if ($action instanceof Closure) {
            $action = function() use ($action) {
                return ClosureResponse::getInstance($action);
            };
        }

        if (is_callable($action)) {
            if (static::isControllerAction($action)) {
                static::getInstance()->response = static::runControllerAction($action);
            } else {
                static::getInstance()->response = $action();
            }
        }

        if (!(static::getInstance()->response instanceof BaseResponse)) {
            throw new Exception('Controller must return response of class ' . BaseResponse::class);
        }
    }

    public static function isControllerAction($callable): bool
    {
        return is_array($callable);
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

    public function getResponse(): BaseResponse
    {
        return $this->response;
    }
}
