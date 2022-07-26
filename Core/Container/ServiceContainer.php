<?php

namespace Core\Container;

use Closure;
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

    /**
     * @param string $abstract
     * @param class-string|Closure $concrete
     */
    public function bind(string $abstract, string|Closure $concrete)
    {
        $this->binds[$abstract] = $concrete;
    }

    /**
     * @throws ReflectionException
     */
    public function resolve(string $abstract)
    {
        if (!isset($this->binds[$abstract])) {
            return $this->build($abstract);
        }
        if ($this->binds[$abstract] instanceof Closure) {
            return $this->binds[$abstract]($this);
        }
        return new $this->binds[$abstract]();
    }

    /**
     * @throws ReflectionException
     */
    protected function build($abstract)
    {
        $ref = new ReflectionClass($abstract);
        $constructor = $ref->getConstructor();
        $constructorDeps = [];
        if ($constructor !== null) {
            $constructorDeps = $this->getClassMethodDependencies($abstract, '__construct');
        }
        $params = [];
        foreach ($constructorDeps as $dep) {
            $params[] = $this->resolve($dep);
        }
        return new $abstract(...$params);
    }

    public function resolveMethod($classInstance, $method)
    {
        $deps = $this->getClassMethodDependencies($classInstance::class, $method);
        $params = [];
        foreach ($deps as $dep) {
            $params[] = $this->resolve($dep);
        }
        return $classInstance->$method(...$params);
    }

    /**
     * TODO check if constructor exists here, if not - return null or []
     * @throws ReflectionException
     */
    public function getClassMethodDependencies(string $class, string $method)
    {
        $ref = new ReflectionClass($class);

        $params = $ref->getMethod($method)->getParameters();
        $deps = [];
//        dd($class, false);
//        dd($method, false);
//        dd($params, false);
        foreach ($params as $param) {
            if (
                $param->getType() instanceof \ReflectionNamedType
                && (class_exists($param->getType()->getName())
                    || interface_exists($param->getType()->getName())
                )
            ) {
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