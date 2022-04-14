<?php

namespace Core\Routing;

use Exception;

class View
{
    /** @var array $sections sections of this exact view */
    protected array $sections = [];
    protected string $path;
    protected array $data;
    /** @var array $childSections sections of the view that extends this one */
    protected array $childSections;
    protected string $extends;
    protected string $currentSection;
    protected array $stacks = [];

    public function __construct($path, $data = [], $childSections = [], $stacks = [])
    {
        $this->path = $path;
        $this->data = $data;
        $this->childSections = $childSections;
        $this->stacks = $stacks;
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
     * @param string $data If this is provided then this is basically ends the section
     * with this data provided to the section -> no endSection() needed after.
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

    /**
     * If yield section is mentioned in extending view sections ($this->section(*yield name*)),
     * then process this yielded section.
     *
     * @param string $yields
     * @return void
     */
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

    public function stack(string $stackName)
    {
        if (isset($this->stacks[$stackName]) && is_array($this->stacks[$stackName])) {
            foreach ($this->stacks[$stackName] as $stackData) {
                echo $stackData;
            }
        }
    }

    /**
     * Push to the stack
     *
     * @param string $stackName
     * @param $data
     * @return void
     */
    public function push(string $stackName, $data)
    {
        $this->stacks[$stackName][] = $data;
    }

    public function getStacks(): array
    {
        return $this->stacks;
    }
}
