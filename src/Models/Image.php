<?php

namespace ABCreche\Printer\Models;

use ABCreche\Printer\UnitConvert;
use ABCreche\Printer\Traits\HasStyles;

class Image
{
    use HasStyles;

    public string $path;
    public int $top;
    public int $right;
    public int $bottom;
    public int $left;

    public static function make(string $path, int $top, int $right, int $bottom, int $left): self
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
