<?php

namespace Core;

class BaseResponse extends Singleton
{
    protected $data;

    public function __construct($data)
    {
        parent::__construct();
        $this->data = $data;
    }

    protected function applyHeaders()
    {
    }

    protected function processData()
    {
    }

    public function send()
    {
        $this->applyHeaders();
        $this->processData();
        echo $this->data;
        die();
    }
}
