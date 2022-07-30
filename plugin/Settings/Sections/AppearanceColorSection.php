<?php

namespace Ravand\Settings\Sections;

use Ravand\Foundation\Settings\Section;

class AppearanceColorSection extends Section
{
    protected $fields = [
        \Ravand\Settings\Fields\PrimaryColorField::class,
        \Ravand\Settings\Fields\SuccessColorField::class,
        \Ravand\Settings\Fields\WarningColorField::class,
        \Ravand\Settings\Fields\DangerColorField::class,
        \Ravand\Settings\Fields\InfoColorField::class
    ];

    public function render()
    {

    }

    public function title()
    {
        return "Panel Colors";
    }
}