<?php

namespace Core\Routing;

use Core\Container\ServiceContainer;
use Core\Responses\ClosureResponse;
use ReflectionException;

class RouteDispatcher
{
    private $action;
    private ServiceContainer $container;

    public function __construct(ServiceContainer $container, $action)
    {
        $this->container = $container;
        $this->action = $action;
    }

    /**
     * @throws ReflectionException
     */
    public function dispatch()
    {
        // TODO remove this hack
        if ($this->action instanceof \Closure) {
            return new ClosureResponse($this->action);
        }
        $deps = $this->container->getClassMethodDependencies($this->action[0], $this->action[1]);
        $params = [];
        foreach ($deps as $dep) {
            $params[] = new ($dep)();
        }
        $class = new ($this->action[0])();
        return $class->{$this->action[1]}(...$params);
    }
}