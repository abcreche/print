<?php

namespace ABCreche\Printer\Models;

use ABCreche\Printer\Traits\HasStyles;

class PrintedView
{
    use HasStyles;

    public string $html;
    public $top;
    public $right;
    public $bottom;
    public $left;

    public static function make(string $html, $top = null, $right = null, $bottom = null, $left = null)
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
