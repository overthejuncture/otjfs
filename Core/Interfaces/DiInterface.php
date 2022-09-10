<?php

namespace Core\Interfaces;

interface DiInterface
{
    public function bind(string $abstract, string $concrete);

    public function resolve(string $abstract);

    public function getClassMethodDependencies(string $class, string $method);

}