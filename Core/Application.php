<?php

namespace Core;

use Core\Container\ServiceContainer;
use Core\Database\SqlConstructors\SqlConstructorFactory;
use Core\Interfaces\SqlConstructorInterface;
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
        $this->bind(SqlConstructorInterface::class, function ($app) {
            $config = config('db');
            return SqlConstructorFactory::createConstructor($config['connection']);
        });
    }
}