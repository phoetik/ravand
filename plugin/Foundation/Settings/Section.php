<?php

namespace Ravand\Foundation\Settings;

abstract class Section
{
    protected $setting;

    protected $fields = [];

    protected $registeredFields = [];

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
        $this->initializeFields();
    }

    private function initializeFields()
    {
        $fieldClasses = $this->fields;
        $fields = [];

        foreach ($fieldClasses as $fieldClass) {
            $fields[$fieldClass] = new $fieldClass($this, $this->setting);
        }

        $this->fields = $fields;
    }

    public function getSetting()
    {
        return $this->setting;
    }

    public function register()
    {
        add_settings_section(
            static::class,
            $this->title(),
            [$this, "render"],
            $this->setting->page()
        );

        $this->registerFields();
    }

    public function registerFields()
    {
        foreach($this->fields as $fieldClass => $field)
        {
            $field->register();

            $this->registeredFields[] = $fieldClass;
        }
    }

    // public function addField()

    abstract public function render();

    public function title()
    {
        return "";
    }
}
