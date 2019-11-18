<?php

namespace ABCreche\Printer\Traits;

trait HasStyles
{
    protected $styles = [];

    public function style($attribute, $property = null)
    {
        if (is_array($attribute)) {
            foreach ($attribute as $key => $property) {
                $this->styles[$key] = $property;
            }
        } else {
            $this->styles[$attribute] = $property;
        }

        return $this;
    }

    public function styles(): array
    {
        return $this->styles;
    }
}
