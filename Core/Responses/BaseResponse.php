<?php

namespace Core\Responses;

use Core\Singleton;

class BaseResponse extends Singleton
{
    protected $data;
    protected $body;

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
        // TODO there is confusion between the use of `body` and `data` in $this
        echo $this->body;
    }
}
