<?php

namespace Core;

use Closure;

class ClosureResponse extends BaseResponse
{
    public function __construct(Closure $data)
    {
        parent::__construct($data);
    }

    /**
     * $this->data transforms to the result of a Closure
     *
     * @return void
     */
    protected function processData()
    {
        ob_start();
        ($this->data)();
        $this->data = ob_get_clean();
    }
}
