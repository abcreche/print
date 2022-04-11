<?php

namespace ABCreche\Printer\Converters;

use ABCreche\Printer\PrintTemplate;
use Spatie\Browsershot\Browsershot;
use ABCreche\Printer\Interfaces\PDFConverter;

class BrowsershotConverter implements PDFConverter
{
    private $instanceId;

    protected $path;

    public function __construct()
    {
        $this->instanceId = uniqid();
    }

    public function convert(PrintTemplate $template, $path): PDFConverter
    {
        $folder = config('printer.directory') .'/'. $this->instanceId;
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
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
