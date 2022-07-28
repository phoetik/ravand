<?php

namespace Ravand\Foundation\Settings;

abstract class Setting
{
    protected $page;

    protected $options;

    protected $sections;

    /**
     * Set settings page slug and option name
     * 
     * @param mixed $page
     * @param mixed $options
     */
    public function __construct($page, $options)
    {
        $this->page = $page;
        $this->options = $options;

        $this->register();
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getOptionsName()
    {
        return $this->options;
    }

    public function register()
    {
        register_settings(
            $this->getPage(), 
            $this->getOptionsName()
        );
    }

    public function addSection(Section $section)
    {
        $section->register($this);
    }
}