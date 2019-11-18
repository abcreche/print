<?php

namespace ABCreche\Printer;

class Writing
{
    public $text;
    public $top;
    public $right;
    public $bottom;
    public $left;

    protected $styles = [];

    public static function make($text, $top, $right, $bottom, $left)
    {
        return (new self)
            ->text($text)
            ->top($top)
            ->right($right)
            ->bottom($bottom)
            ->left($left);
    }

    public function text(string $text)
    {
        $this->text = $text;

        return $this;
    }

    public function top($unit)
    {
        $this->top = $unit;
        // UnitConvert::pixels($unit)->toMilimeters();

        return $this;
    }

    public function right($unit)
    {
        $this->right = $unit;
        // UnitConvert::pixels($unit)->toMilimeters();

        return $this;
    }

    public function bottom($unit)
    {
        $this->bottom = $unit;
        // UnitConvert::pixels($unit)->toMilimeters();

        return $this;
    }

    public function left($unit)
    {
        $this->left = $unit;
        // UnitConvert::pixels($unit)->toMilimeters();

        return $this;
    }

    public function style(string $attribute, string $property)
    {
        $this->styles[$attribute] = $property;
    }

    public function styles()
    {
        return array_merge([
            'top' => $this->top,
            'right' => $this->right,
            'bottom' => $this->bottom,
            'left' => $this->left,
        ], $this->styles);
    }
}
