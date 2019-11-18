<?php

namespace ABCreche\Printer;

use ABCreche\Printer\Interfaces\PDFConverter;
use Illuminate\Support\Str;

class Printer
{
    public function __construct(PDFConverter $converter)
    {
        $this->converter = $converter;
    }

    public function download(PrintTemplate $printTemplate, string $fileName, array $headers = [])
    {
        $fileName = Str::finish($fileName, '.pdf');

        return response()->download(
            $this->print($printTemplate, $fileName)->getLocalPath(),
            $fileName,
            $headers
        )->deleteFileAfterSend(true);
    }

    protected function print($printTemplate, string $fileName)
    {
        return $this->converter->convert($printTemplate, $fileName);
    }
}
