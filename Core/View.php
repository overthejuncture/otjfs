<?php

namespace Core;

class View
{
    private array $sections;
    private string $extends;
    private string $path;
    private array $data;
    private string $currentSection;

    public function __construct($path, $data = [], $sections = [])
    {
        $this->path = $path;
        $this->data = $data;
        $this->sections = $sections;
    }

    public function process()
    {
        extract($this->data);
        ob_start();
        include $this->path;
        return ob_get_clean();
    }

    public function extend(string $extendedViewName)
    {
        $this->extends = $extendedViewName;
    }

    public function section(string $section)
    {
        ob_start();
        $this->currentSection = $section;
    }

    public function endSection()
    {
        $this->sections[$this->currentSection] = ob_get_clean();
        $this->currentSection = '';
    }

    /**
     * @return string
     */
    public function getExtends(): string
    {
        return $this->extends ?? false;
    }

    public function yield(string $yields)
    {
        if (isset($this->sections[$yields])) {
            echo $this->sections[$yields];
        }
    }

    /**
     * @return array
     */
    public function getSections(): array
    {
        return $this->sections;
    }
}
