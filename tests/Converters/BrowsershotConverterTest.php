<?php

namespace ABCreche\Printer\Test\Converters;

use ABCreche\Printer\Test\TestCase;
use ABCreche\Printer\Interfaces\PDFConverter;
use ABCreche\Printer\Converters\BrowsershotConverter;
use ABCreche\Printer\Test\Data\Stubs\EmptyPrintTemplate;

class BrowsershotConverterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->template = new EmptyPrintTemplate;
        $this->converter = new BrowsershotConverter;
    }

    /** @test */
    function browsershot_converter_is_a_pdf_converter()
    {
        $this->assertInstanceOf(PDFConverter::class, $this->converter);
    }

    /** @test */
    function browsershot_converter_can_convert()
    {
        $response = $this->converter->convert($this->template, 'test.pdf');

        $this->assertInstanceOf(PDFConverter::class, $response);
        $this->assertStringContainsString('/test.pdf', $response->getLocalPath());
    }
}
