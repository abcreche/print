<?php

namespace ABCreche\Printer\Test;

use ABCreche\Printer\Facades\Printer as PrinterFacade;
use ABCreche\Printer\Test\Data\Stubs\EmptyPrintTemplate;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PrintTemplateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->template = new EmptyPrintTemplate;
        $this->template->addPage();
    }

    /** @test */
    function can_write_data()
    {
        $this->template->addPage();
        $this->template->lastPage()->write('first data');

        $this->assertCount(1, $this->template->lastPage()->getWritings());
        $this->assertEquals('first data', $this->template->lastPage()->getWritings()->first()->text);
    }

    /** @test */
    function can_write_data_and_specify_position()
    {
        $this->template->addPage();
        $this->template->lastPage()->write('first data')
            ->left(1)
            ->right(1);

        $this->assertCount(1, $this->template->lastPage()->getWritings());
        $this->assertEquals('first data', $this->template->lastPage()->getWritings()->first()->text);
    }

    /** @test */
    function data_has_zero_position_by_default()
    {
        $this->template->addPage();
        $this->template->lastPage()->write('first data');

        $styles = $this->template->lastPage()->getWritings()->first()->styles();

        $this->assertEquals(0, $styles['top']);
        $this->assertEquals(0, $styles['right']);
        $this->assertEquals(0, $styles['bottom']);
        $this->assertEquals(0, $styles['left']);
    }

    /** @test */
    function data_can_be_overriden()
    {
        $this->template->addPage();
        $this->template->lastPage()->write('first data')
            ->top(5)
            ->right(6)
            ->bottom(7)
            ->left(8);

        $styles = $this->template->lastPage()->getWritings()->last()->styles();

        $this->assertEquals(5, $styles['top']);
        $this->assertEquals(6, $styles['right']);
        $this->assertEquals(7, $styles['bottom']);
        $this->assertEquals(8, $styles['left']);

        $this->template->lastPage()->write('second data');
        $styles = $this->template->lastPage()->getWritings()->last()->styles();

        $this->assertEquals(0, $styles['top']);
        $this->assertEquals(0, $styles['right']);
        $this->assertEquals(0, $styles['bottom']);
        $this->assertEquals(0, $styles['left']);
    }

    /** @test */
    function can_set_font_to_serif()
    {
        $this->template->serif();

        $styles = $this->template->styles();

        $this->assertArrayHasKey('font-family', $styles);
        $this->assertEquals('serif', $styles['font-family']);
    }

    /** @test */
    function can_set_font_to_sans_serif()
    {
        $this->template->sansSerif();

        $styles = $this->template->styles();

        $this->assertArrayHasKey('font-family', $styles);
        $this->assertEquals('sans-serif', $styles['font-family']);
    }

    /** @test */
    function can_define_page_margins()
    {
        $this->template->margins(10);

        $this->assertEquals(10, $this->template->pageMargin);
    }

    /** @test */
    function template_can_be_rendered_as_html()
    {
        $this->template->addPage();
        $this->template->lastPage()->write('lol');

        $this->assertInstanceOf(View::class, $this->template->render());
        $this->assertStringContainsString('lol', $this->template->render()->toHtml());
    }
}
