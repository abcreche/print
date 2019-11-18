<?php

namespace ABCreche\Printer\Interfaces;

use ABCreche\Printer\PrintTemplate;

interface PDFConverter
{
    public function convert(PrintTemplate $template, $filename): PDFConverter;
    public function getLocalPath();
}
