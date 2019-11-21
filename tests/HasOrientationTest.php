<?php

namespace ABCreche\Printer\Test;

use ABCreche\Printer\Printer;
use ABCreche\Printer\Test\Data\Stubs\EmptyPrintTemplate;
use Illuminate\Support\Collection;

class HasOrientationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->template = new EmptyPrintTemplate;
    }

    /** @test */
    function can_set_orientation_to_portrait()
    {
        $this->template->portrait();

        $this->assertEquals('portrait', $this->template->getOrientation());

        $renderedHtml = $this->template->render()->toHtml();
        $this->assertStringContainsString("size: 210mm 297mm", $renderedHtml);
    }

    /** @test */
    function can_set_orientation_to_landscape()
    {
        $this->template->landscape();

        $this->assertEquals('landscape', $this->template->getOrientation());

        $renderedHtml = $this->template->render()->toHtml();
        $this->assertStringContainsString("size: 297mm 210mm", $renderedHtml);
    }
}
