<?php

namespace ABCreche\Printer\Converters;

use ABCreche\Printer\PrintTemplate;
use Dompdf\Dompdf;
use ABCreche\Printer\Interfaces\PDFConverter;

class DompdfConverter implements PDFConverter
{
    protected $path;

    public function convert(PrintTemplate $template, $path): PDFConverter
    {
        $this->path = config('printer.directory') . '/' . $path;

        $dompdf = new Dompdf();

        $dompdf->loadHtml($template->render()->toHtml());

        $dompdf->setPaper('A4', $template->getOrientation());

        $dompdf->render();

        $output = $dompdf->output();

        file_put_contents($this->path, $output);

        return $this;
    }

    public function getLocalPath()
    {
        return $this->path;
    }
}
