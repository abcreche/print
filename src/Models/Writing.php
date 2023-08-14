<?php

namespace ABCreche\Printer\Models;

use ABCreche\Printer\Traits\HasStyles;

class Writing
{
    use HasStyles;

    public string $text;

    public static function make($text, $top, $right, $bottom, $left, array $styles = []): self
    {
        return (new self)
            ->text($text)
            ->top($top)
            ->right($right)
            ->bottom($bottom)
            ->left($left)
            ->style($styles);
    }

    public function text(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function top($unit): self
    {
        $this->style('top', $unit);

        return $this;
    }

    public function right($unit): self
    {
        $this->style('right', $unit);

        return $this;
    }

    public function bottom($unit): self
    {
        $this->style('bottom', $unit);

        return $this;
    }

    public function left($unit): self
    {
        $this->style('left', $unit);

        return $this;
    }
}
