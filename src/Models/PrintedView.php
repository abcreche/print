<?php

namespace ABCreche\Printer\Models;

use ABCreche\Printer\Traits\HasStyles;

class PrintedView
{
    use HasStyles;

    public string $html;
    public int $top;
    public int $right;
    public int $bottom;
    public int $left;

    public static function make(string $html, int $top, int $right, int $bottom, int $left)
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
