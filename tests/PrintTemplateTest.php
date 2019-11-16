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

    /** @test */
    function data_can_be_overriden()
    {
        $this->template->write('first data')
            ->top(5)
            ->right(6)
            ->bottom(7)
            ->left(8);

        $this->assertEquals(5, $this->template->getWritings()->first()['top']);
        $this->assertEquals(6, $this->template->getWritings()->first()['right']);
        $this->assertEquals(7, $this->template->getWritings()->first()['bottom']);
        $this->assertEquals(8, $this->template->getWritings()->first()['left']);

        $this->template->write('second data');

        $this->assertEquals(0, $this->template->getWritings()->last()['top']);
        $this->assertEquals(0, $this->template->getWritings()->last()['right']);
        $this->assertEquals(0, $this->template->getWritings()->last()['bottom']);
        $this->assertEquals(0, $this->template->getWritings()->last()['left']);
    }
}
