<?php

namespace Ravand\Settings;

use Ravand\Foundation\Settings\Setting;

class Appearance extends Setting
{
    public $sections = [
        Sections\AppearanceColorSection::class
    ];
    
    public function sanitize()
    {
        //
    }

    public function getSubmitButtonText()
    {
        return "Sub Mit";
    }
}