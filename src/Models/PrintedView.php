<?php

namespace ABCreche\Printer\Models;

use ABCreche\Printer\Traits\HasStyles;

class PrintedView
{
    use HasStyles;

    public $html;
    public $top;
    public $right;
    public $bottom;
    public $left;

    public static function make($html, $top, $right, $bottom, $left)
    {
        $view = new self;
        $view->html = $html;
        $view->style('top', $top);
        $view->style('right', $right);
        $view->style('bottom', $bottom);
        $view->style('left', $left);

        return $view;
    }
}
