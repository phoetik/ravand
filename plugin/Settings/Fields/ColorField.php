<?php

namespace Ravand\Settings\Fields;

use Ravand\Foundation\Settings\Field;

class ColorField extends Field
{
    public function render()
    {
        echo '<input type="text" name="'.$this->name().'" value="' . $this->value() . '" class="color-picker" >';
    }
}