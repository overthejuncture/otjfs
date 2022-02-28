<?php

namespace Core;

class Request extends Singleton
{
    private $method;
    private $uri;

    public function __construct()
    {
        parent::__construct();
        $serv = $_SERVER;
        $this->method = mb_strtolower($serv['REQUEST_METHOD']);
        $this->uri = $serv['REQUEST_URI'];
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }
}
