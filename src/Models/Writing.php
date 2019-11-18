<?php

namespace ABCreche\Printer\Models;

use ABCreche\Printer\Traits\HasStyles;

class Writing
{
    use HasStyles;

    public $text;

    public static function make($text, $top, $right, $bottom, $left, array $styles = [])
    {
        return (new self)
            ->text($text)
            ->top($top)
            ->right($right)
            ->bottom($bottom)
            ->left($left)
            ->style($styles);
    }

    public function text(string $text)
    {
        $this->text = $text;

        return $this;
    }

    public function top($unit)
    {
        $this->style('top', $unit);

        return $this;
    }

    public function right($unit)
    {
        $this->style('right', $unit);

        return $this;
    }

    public function bottom($unit)
    {
        $this->style('bottom', $unit);

        return $this;
    }

    public function left($unit)
    {
        $this->style('left', $unit);

        return $this;
    }
}
