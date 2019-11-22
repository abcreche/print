<?php

namespace ABCreche\Printer\Converters;

use ABCreche\Printer\PrintTemplate;
use Spatie\Browsershot\Browsershot;
use ABCreche\Printer\Interfaces\PDFConverter;

class BrowsershotConverter implements PDFConverter
{
    protected $path;

    public function convert(PrintTemplate $template, $path): PDFConverter
    {
        Browsershot::html($template->render()->toHtml())
            ->format('A4')
            ->showBackground()
            ->save($path);

        $this->path = $path;

        return $this;
    }

    public function getLocalPath()
    {
        return $this->path;
    }
}
