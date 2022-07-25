<?php

namespace Core;

use Core\Requests\Request;
use Core\Routing\Router;
use Core\Routing\RouteDispatcher;

class Kernel
{
    private Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle(Request $request)
    {
        $uri = $request->getUri();
        $method = $request->getMethod();
        $this->router->readRoutes();
        $action = $this->router->match($uri, $method);
//        var_dump($action);
//        die();
        $dispatcher = new RouteDispatcher($action);
        $response = $dispatcher->dispatch();
        $response->send();

//        var_dump($action);
    }
}