<?php

namespace ABCreche\Printer\Models;

use ABCreche\Printer\UnitConvert;
use ABCreche\Printer\Traits\HasStyles;

class Image
{
    use HasStyles;

    public string $path;
    public $top;
    public $right;
    public $bottom;
    public $left;

    public static function make(string $path, $top = null, $right = null, $bottom = null, $left = null): self
    {
        $image = new self;
        $image->path = $path;
        $image->style('top', UnitConvert::pixels($top)->toPixels());
        $image->style('right', UnitConvert::pixels($right)->toPixels());
        $image->style('bottom', UnitConvert::pixels($bottom)->toPixels());
        $image->style('left', UnitConvert::pixels($left)->toPixels());

        return $image;
    }
}
