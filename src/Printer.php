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
        $fileName = $this->fixFileName($fileName);

        return response()->download(
            $this->print($printTemplate, $fileName)->getLocalPath(),
            $fileName,
            $headers
        )->deleteFileAfterSend(true);
    }

    public function preview(PrintTemplate $printTemplate, string $fileName, array $headers = [])
    {
        $fileName = $this->fixFileName($fileName);

        return response()->file(
            $this->print($printTemplate, $fileName)->getLocalPath(),
            $headers
        )->deleteFileAfterSend();
    }

    protected function print($printTemplate, string $fileName)
    {
        return $this->converter->convert($printTemplate, $fileName);
    }

    protected function fixFileName(string $fileName)
    {
        return Str::finish($fileName, '.pdf');
    }
}
