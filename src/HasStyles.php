<?php

namespace ABCreche\Printer;

trait HasStyles
{
    protected $styles = [];

    public function style(string $attribute, string $property)
    {
        $this->styles[$attribute] = $property;
    }

    public function styles(): array
    {
        return $this->styles;
    }
}
