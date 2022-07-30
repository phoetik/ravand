<?php

namespace Ravand\Foundation\Settings;

abstract class Field
{
    protected $section;
    
    protected $setting;

    protected $for;

    protected $class;

    public function __construct(Section $section, Setting $setting)
    {
        $this->section = $section;
        $this->setting = $setting;
    }

    public function value()
    {
        return $this->setting->option($this->section,$this);
    }
    
    public function name()
    {
        return $this->setting->optionName().'['.$this->section::class.']['.$this::class.']';
    }

    public function register()
    {
        
        add_settings_field( 
            static::class, 
            $this->title(), 
            [$this, "render"], 
            $this->setting->page(), 
            $this->section::class, 
            [
                "label_for" => $this->for,
                "class" => $this->class
            ]
        );
    }

    abstract public function render();

    public function title()
    {
        return "";
    }

    public function default()
    {
        return "";
    }
}
