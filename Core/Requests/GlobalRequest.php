<?php

namespace Core\Requests;

class GlobalRequest
{
    protected string $method;
    protected string $uri;
    protected array $data;

    public function __construct()
    {
        $this->method = mb_strtolower($_SERVER['REQUEST_METHOD']);
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->data = array_merge($_POST, $_GET);
    }

    public function getData()
    {
        return $this->data;
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
