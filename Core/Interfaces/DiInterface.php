<?php

namespace Core\Interfaces;

interface DiInterface
{
    public function bind(string $abstract, string $concrete);

    public function resolve(string $abstract);

    public function getDependencies(string $class);

    public function getClassMethodDependencies(string $class, string $method);

}