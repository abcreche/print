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

        return $this;
    }

    public function landscape()
    {
        $this->orientation = 'landscape';

        return $this;
    }

    public function getOrientation(): string
    {
        return $this->orientation;
    }
}
