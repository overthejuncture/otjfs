<?php

namespace Core\Container;

use Core\Interfaces\DiInterface;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;

class ServiceContainer implements ContainerInterface, DiInterface
{
    private array $binds;

    /**
     * @throws ContainerException
     */
    public function get(string $id)
    {
        throw new ContainerException();
    }

    /**
     * @throws NotFoundException
     */
    public function has(string $id): bool
    {
        throw new NotFoundException();
    }

    public function bind(string $abstract, string $concrete)
    {
        $this->binds[$abstract] = $concrete;
        return true;
    }

    public function resolve(string $abstract)
    {
        return new $this->binds[$abstract]();
    }

    /**
     * @throws ReflectionException
     */
    public function getClassMethodDependencies(string $class, string $method)
    {
        $ref = new ReflectionClass($class);

        $params = $ref->getMethod($method)->getParameters();
        $deps = [];
        foreach ($params as $param) {
            if (class_exists($param->getType()->getName())) {
                $deps[] = $param->getType()->getName();
            }
        }
        return $deps;
    }

    public function getDependencies(string $class)
    {
        // TODO: Implement getDependencies() method.
    }
}