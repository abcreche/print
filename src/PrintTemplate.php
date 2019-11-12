<?php

namespace ABCreche\Printer;

abstract class PrintTemplate
{
    protected $orientation = 'portrait';

    public function write(string $text)
    {
        # code...
    }

    public function top($position)
    {
        # code...
    }

    public function right($position)
    {
        # code...
    }

    public function bottom($position)
    {
        # code...
    }

    public function left($position)
    {
        # code...
    }
}
