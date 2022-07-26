<?php

namespace Core\Routing;

class Router implements RouterInterface
{
    private string $path;
    private array $routes = [];

    public function __construct(array $config)
    {
        // TODO what if there are multiple files
        $this->path = $config['base_path'];
    }

    public function readRoutes()
    {
        require_once $this->path;
        $this->routes = Route::getPaths();
    }

    public function match($uri, $method)
    {
        return $this->routes[$method][$uri];
    }
}