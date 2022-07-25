<?php

namespace Core\Routing;

interface RouterInterface
{
    public function readRoutes();

    public function match($uri, $method);
}