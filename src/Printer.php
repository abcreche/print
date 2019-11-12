<?php

namespace ABCreche\Printer;

class Printer
{
    public function download(PrintTemplate $printTemplate, string $fileName, string $writerType = null, array $headers = [])
    {
        return response()->download(
            $this->makeFile($printTemplate, $fileName, $writerType)->getLocalPath(),
            $fileName,
            $headers
        )->deleteFileAfterSend(true);
    }

    protected function makeFile(PrintTemplate $printTemplate, string $fileName, string $writerType = null): TemporaryFile
    {
        return view('layout');
    }
}
