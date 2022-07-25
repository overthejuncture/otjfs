<?php

namespace Core\Routing;

class Router
{
    private string $path;
    private array $routes = [];

    public function __construct(string $pathToRoutes)
    {
        $this->path = $pathToRoutes;
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