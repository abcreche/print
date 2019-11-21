<?php

namespace ABCreche\Printer\Models;

use ABCreche\Printer\Traits\HasStyles;

class PrintedView
{
    use HasStyles;

    public $path;
    public $data;
    public $top;
    public $right;
    public $bottom;
    public $left;

    public static function make($path, $data, $top, $right, $bottom, $left)
    {
        $image = new self;
        $image->path = $path;
        $image->data = $data;
        $image->style('top', $top);
        $image->style('right', $right);
        $image->style('bottom', $bottom);
        $image->style('left', $left);

        return $image;
    }
}
