<?php

namespace ABCreche\Printer\Test;

use ABCreche\Printer\Facades\Printer as PrinterFacade;
use ABCreche\Printer\Test\Data\Stubs\EmptyPrintTemplate;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PrintTemplateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->template = new EmptyPrintTemplate;
    }

    /** @test */
    function can_write_data()
    {
        $this->template->write('first data');

        $this->assertCount(1, $this->template->getWritings());
        $this->assertEquals('first data', $this->template->getWritings()->first()['text']);
    }

    /** @test */
    function data_has_zero_position_by_default()
    {
        $this->template->write('first data');

        $this->assertEquals(0, $this->template->getWritings()->first()['top']);
        $this->assertEquals(0, $this->template->getWritings()->first()['right']);
        $this->assertEquals(0, $this->template->getWritings()->first()['bottom']);
        $this->assertEquals(0, $this->template->getWritings()->first()['left']);
    }
}
