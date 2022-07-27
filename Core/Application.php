<?php

namespace Core;

use Core\Container\ServiceContainer;
use Core\Routing\Router;
use Core\Routing\RouterInterface;

class Application extends ServiceContainer
{
    public function __construct()
    {
        $this->bindEssentials();
    }

    protected function bindEssentials()
    {
        $this->bind(ServiceContainer::class, function ($app) {
            return $this;
        });
        $this->bind(RouterInterface::class, function ($app) {
            return new Router(config('routing'));
        });
    }
}