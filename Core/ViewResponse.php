<?php

namespace Core;

class ViewResponse extends BaseResponse
{
    /**
     * @var string
     */
    private $path;

    public function __construct(string $path, $data = [])
    {
        parent::__construct($data);
        $this->path = $path;
        dd($this);
    }
}
