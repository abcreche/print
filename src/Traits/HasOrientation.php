<?php

namespace ABCreche\Printer\Traits;

trait HasOrientation
{
    /**
     * Defines the orientation of the page when being printed
     */
    protected $orientation = 'portrait';

    public function portrait()
    {
        $this->orientation = 'portrait';
    }

    public function landscape()
    {
        $this->orientation = 'landscape';
    }
}
