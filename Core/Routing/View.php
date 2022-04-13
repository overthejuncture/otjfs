<?php

namespace Core\Routing;

use Exception;

class View
{
    /** @var array $sections sections of this exact view */
    private array $sections = [];
    /** @var array $childSections sections of the view that extends this one */
    private array $childSections;
    private string $extends;
    private string $path;
    private array $data;
    private string $currentSection;

    public function __construct($path, $data = [], $childSections = [])
    {
        $this->path = $path;
        $this->data = $data;
        $this->childSections = $childSections;
    }

    /**
     * @throws Exception
     */
    public function process()
    {
        if (!file_exists($this->path)) {
            throw new Exception("No file found for view $this->path");
        }
        extract($this->data);
        ob_start();
        include $this->path;
        return ob_get_clean();
    }

    public function extend(string $extendedViewName)
    {
        $this->extends = $extendedViewName;
    }

    /**
     *
     * @param string $section
     * @param string $data If this is provided than this is basically ends the section
     * with this data provided to the section. No endSection() needed after that.
     * @return void
     */
    public function section(string $section, string $data = '')
    {
        if ($data) {
            $this->sections[$section] = $data;
        } else {
            ob_start();
            $this->currentSection = $section;
        }
    }

    public function endSection()
    {
        $this->sections[$this->currentSection] = ob_get_clean();
        $this->currentSection = '';
    }

    /**
     * @return string
     */
    public function getExtendedView(): string
    {
        return $this->extends ?? false;
    }

    public function yield(string $yields)
    {
        if (isset($this->childSections[$yields])) {
            echo $this->childSections[$yields];
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
