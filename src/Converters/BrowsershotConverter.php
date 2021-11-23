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
        $folder = config('printer.directory') . '/' . time();
        if (!is_dir($this->basePath)) {
            mkdir($this->basePath);
        }
        $this->path = $folder . '/' . $path;

        Browsershot::html($template->render()->toHtml())
            ->format('A4')
            ->showBackground()
            ->save($this->path);

        return $this;
    }

    public function getLocalPath()
    {
        return $this->path;
    }
}
