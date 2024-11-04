<?php

namespace Core\Container;

use Closure;
use Core\Interfaces\DiInterface;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;

class ServiceContainer implements ContainerInterface, DiInterface
{
    /**
     * @var array<string, object> $binds
     */
    private array $binds;

    /**
     * @var array<string, object> $instances
     */
    private array $instances;

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
    public function bind(string $abstract, string|Closure $concrete): void
    {
        $this->binds[$abstract] = $concrete;
    }

    public function instance(string $abstract, Object $class): void
    {
        $this->instances[$abstract] = $class;
    }

    /**
     * @throws ReflectionException
     */
    public function resolve(string $abstract): object
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
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
    protected function build(string $abstract): object
    {
        $constructorDeps = $this->getClassConstructorDependencies($abstract);
        $params = [];
        foreach ($constructorDeps as $dep) {
            $params[] = $this->resolve($dep);
        }
        return new $abstract(...$params);
    }

    public function resolveMethod(object $classInstance, string $method): mixed
    {
        $deps = $this->getClassMethodDependencies($classInstance::class, $method);
        $params = [];
        foreach ($deps as $dep) {
            $params[] = $this->resolve($dep);
        }
        return $classInstance->$method(...$params);
    }

    /**
     * @return array<string>
     *
     * @throws ReflectionException
     */
    protected function getClassConstructorDependencies(string $class): array
    {
        $ref = new ReflectionClass($class);
        $constructor = $ref->getConstructor();
        if ($constructor === null) {
            return [];
        }
        return $this->getClassMethodDependencies($class, '__construct');
    }

    /**
     * @return array<string>
     *
     * @throws ReflectionException
     */
    public function getClassMethodDependencies(string $class, string $method): array
    {
        $ref = new ReflectionClass($class);

        $params = $ref->getMethod($method)->getParameters();
        $deps = [];
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
}
