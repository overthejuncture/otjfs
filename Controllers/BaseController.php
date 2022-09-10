<?php

namespace Controllers;

use Core\Container\ServiceContainer;

class BaseController
{
    protected ServiceContainer $container;

    public function setContainer(ServiceContainer $container): void
    {
        $this->container = $container;
    }
}