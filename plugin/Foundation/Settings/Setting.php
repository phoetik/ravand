<?php

namespace Ravand\Foundation\Settings;

class Setting
{
    protected $pageSlug;

    public function __construct($pageSlug, $optionsName)
    {
        $this->pageSlug = $pageSlug;
        $this->optionsName = $optionsName;

        register_settings($pageSlug, $optionsName);
    }

    public function addSection(Section $section)
    {

    }
}
