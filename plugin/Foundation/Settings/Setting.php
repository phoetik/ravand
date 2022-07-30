<?php

namespace Ravand\Foundation\Settings;

abstract class Setting
{
    protected $page;

    protected $optionName;

    protected $sections = [];

    protected $registeredSections = [];

    /**
     * Set settings page slug and option name
     *
     * @param mixed $page
     * @param mixed $options
     */
    public function __construct($page, $optionName)
    {
        $this->page = $page;
        $this->optionName = $optionName;

        $this->initializeSections();
        $this->register();
    }

    private function initializeSections()
    {
        $sectionClasses = $this->sections;
        $sections = [];

        foreach ($sectionClasses as $sectionClass) {
            $sections[$sectionClass] = new $sectionClass($this);
        }

        $this->sections = $sections;
    }

    public function register()
    {
        \register_setting(
            $this->page(),
            $this->optionName()
        );
    }
    
    public function addSection(Section $section)
    {
        if (!array_key_exists($section::class, $this->sections)) {
            $this->sections[$section::class] = $section;
        }
    }

    public function page()
    {
        return $this->page;
    }

    public function optionName()
    {
        return $this->optionName;
    }
    
    public function option(Section $section, Field $field)
    {
        $option = \get_option($this->optionName());

        if($option === false)
        {
            $option = [];
        }

        return $option[$section::class][$field::class] ?? $field->default(); 
    }

    public function registerSections()
    {
        foreach($this->sections as $sectionClass => $section)
        {
            $section->register();

            $this->registeredSections[] = $sectionClass;
        }
    }

    abstract public function getSubmitButtonText();

    public function render()
    {
        \settings_fields($this->page());
        \do_settings_sections($this->page());
        \submit_button($this->getSubmitButtonText());
    }
}
