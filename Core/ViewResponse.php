<?php

namespace Core;

class ViewResponse extends BaseResponse
{
    /**
     * @var string
     */
    private $path;

    private $basePath = 'layouts/';

    public function __construct(string $path, array $data = [])
    {
        parent::__construct($data);
        $this->path = $path . '.php';
    }

    protected function processData()
    {
        parent::processData();
        $this->getViewFile();
    }

    private function getViewFile()
    {
        ob_start();
        extract($this->data);
        include_once(basePath() . $this->basePath . $this->path);
        $this->data = ob_get_clean();
    }
}
