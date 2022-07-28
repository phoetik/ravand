<?php

namespace Ravand\Foundation\Settings;

abstract class Section
{
    public function register(Setting $setting)
    {
        add_settings_section(
            self::class,
            $this->getTitle(),
            [$this, "render"],
            $setting->getPage()
        );
    }

    // public function addField()

    abstract public function render();

    abstract public function getTitle();
}

(new Ravand\Settings\AppearanceSettings("wporg", "wporg_options"))->register([

]);
