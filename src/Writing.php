<?php

namespace ABCreche\Printer;

class Writing
{
    use HasStyles;

    public $text;
    public $top;
    public $right;
    public $bottom;
    public $left;

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
