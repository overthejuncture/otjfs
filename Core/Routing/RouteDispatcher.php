<?php

namespace Core\Routing;

use Closure;
use Core\Container\ServiceContainer;
use Core\Responses\ClosureResponse;
use ReflectionException;

class RouteDispatcher
{
    /**
     * @var array<class-string, string>|Closure
     */
    private array|Closure $action;
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
        if ($this->action instanceof Closure) {
            return new ClosureResponse($this->action);
        }
        $class = $this->container->resolve($this->action[0]);
        return $this->container->resolveMethod($class, $this->action[1]);
    }
}