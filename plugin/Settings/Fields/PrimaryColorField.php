<?php

namespace Ravand\Settings\Fields;

class PrimaryColorField extends ColorField
{
    use Traits\Colors\Primary;

    public function title()
    {
        return "Primary Color";
    }
}