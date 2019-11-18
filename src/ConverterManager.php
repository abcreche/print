<?php

namespace ABCreche\Printer;

use Illuminate\Support\Manager;
use ABCreche\Printer\Converters\BrowsershotConverter;

class ConverterManager extends Manager
{
    /**
     * Create an instance of the Browsershot driver
     *
     * @return BrowsershotConverter
     */
    protected function createBrowsershotDriver()
    {
        return new BrowsershotConverter;
    }

    /**
     * Get the default driver
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']['printer.converter'];
    }
}
