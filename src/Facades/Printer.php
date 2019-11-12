<?php

namespace ABCreche\Printer\Facades;

use Illuminate\Support\Facades\Facade;

class Printer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'printer';
    }
}
