<?php

namespace Core;

use Exception;

class ViewResponse extends BaseResponse
{
    private string $viewPath;

    public function __construct(string $viewPath, array $data = [])
    {
        parent::__construct($data);
        $this->viewPath= $viewPath;
    }

    /**
     * @throws Exception
     */
    protected function processData()
    {
        parent::processData();
        $this->body = ViewConstructor::compile($this->viewPath, $this->data);
    }
}
