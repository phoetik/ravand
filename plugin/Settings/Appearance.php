<?php

use Ravand\Foundation\Settings\Setting;

class Appearance extends Setting
{
    public $sections = [
        Sections\Color::class
    ];
    
    public function sanitize()
    {
        //
    }

    public function default()
    {
        return [
            "colors" => [
                "sidebar" => "#fcba03"
            ]
        ];
    }
}