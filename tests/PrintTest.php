<?php

namespace ABCreche\Printer\Test;

use ABCreche\Printer\Facades\Printer as PrinterFacade;
use ABCreche\Printer\Test\Data\Stubs\EmptyPrintTemplate;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PrintTest extends TestCase
{
    /**
     * @test
     */
    public function can_download_a_print_with_facade()
    {
        $export = new EmptyPrintTemplate();
        $response = PrinterFacade::download($export, 'filename.pdf');
        $this->assertInstanceOf(BinaryFileResponse::class, $response);
        $this->assertEquals('attachment; filename=filename.pdf', str_replace('"', '', $response->headers->get('Content-Disposition')));
    }
}
