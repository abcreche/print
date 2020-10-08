<?php

namespace ABCreche\Printer;

use Illuminate\Support\Manager;
use ABCreche\Printer\Converters\DompdfConverter;
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
     * Create an instance of the Dompdf driver
     *
     * @return DompdfConverter
     */
    protected function createDompdfDriver()
    {
        return new DompdfConverter;
    }

    /**
     * Get the default driver
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->container['config']['printer.converter'];
    }
}
