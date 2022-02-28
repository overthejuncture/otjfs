<?php

namespace Core;

class JsonResponse extends BaseResponse
{
    protected function applyHeaders()
    {
        parent::applyHeaders();
        header('Content-type: application/json');
    }

    protected function processData()
    {
        $this->data = json_encode($this->data);
    }
}
