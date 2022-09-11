<?php

namespace Core;

use Core\Container\ServiceContainer;
use Core\Requests\GlobalRequest;
use Core\Routing\RouteDispatcher;
use Core\Routing\RouterInterface;

class Kernel
{
    private RouterInterface $router;
    private ServiceContainer $container;

    public function __construct(ServiceContainer $container, RouterInterface $router)
    {
        $this->container = $container;
        $this->router = $router;
    }

    public function handle(GlobalRequest $request): void
    {
        $uri = $request->getUri();
        $method = $request->getMethod();
        $this->router->readRoutes();
        $action = $this->router->match($uri, $method);
        $dispatcher = new RouteDispatcher($this->container, $action);
        $response = $dispatcher->dispatch();
        if ($response) {
            $response->send();
        }
    }
}