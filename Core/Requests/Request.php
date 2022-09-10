<?php

namespace Core\Requests;

class Request
{
    protected static string $method;
    protected static string $uri;

    public  function __construct()
    {
        $serv = $_SERVER;
        static::$method = mb_strtolower($serv['REQUEST_METHOD']);
        static::$uri = $serv['REQUEST_URI'];
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
