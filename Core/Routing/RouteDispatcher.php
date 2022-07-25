<?php

namespace Core\Routing;

use Core\Responses\ClosureResponse;

class RouteDispatcher
{
    private $action;

    public function __construct($action)
    {
        $this->action = $action;
    }

    public function dispatch()
    {
        // TODO remove this hack
        if ($this->action instanceof \Closure) {
            return new ClosureResponse($this->action);
        }
        return ($this->action)();
    }
}