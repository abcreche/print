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
            $this->path($printTemplate, $fileName),
            $fileName,
            $headers
        )->deleteFileAfterSend(true);
    }

    public function preview(PrintTemplate $printTemplate, string $fileName, array $headers = [])
    {
        $fileName = $this->fixFileName($fileName);

        return response()->file(
            $this->path($printTemplate, $fileName),
            $headers
        )->deleteFileAfterSend();
    }

    public function path(PrintTemplate $printTemplate, string $fileName)
    {
        return $this->print($printTemplate, $fileName)->getLocalPath();
    }

    public function print($printTemplate, string $fileName): PDFConverter
    {
        return $this->converter->convert($printTemplate, $fileName);
    }

    protected function fixFileName(string $fileName)
    {
        return Str::finish($fileName, '.pdf');
    }
}
