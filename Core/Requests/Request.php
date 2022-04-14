<?php

namespace Core\Requests;

use Core\Singleton;

class Request
{
    protected static string $method;
    protected static string $uri;

    protected function __construct()
    {
        $serv = $_SERVER;
        static::$method = mb_strtolower($serv['REQUEST_METHOD']);
        static::$uri = $serv['REQUEST_URI'];
    }

    public static function capture(): Request
    {
        return new static();
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return static::$method;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return static::$uri;
    }
}
