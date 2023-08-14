<?php

namespace ABCreche\Printer\Test;

use ABCreche\Printer\Printer;
use ABCreche\Printer\Test\Data\Stubs\EmptyPrintTemplate;
use Illuminate\Support\Collection;

class HasImagesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->template = new EmptyPrintTemplate;
        $this->template->addPage();
    }

    /** @test */
    function can_add_an_image()
    {
        $this->template->lastPage()->addImage('/dummy/image/path.jpg');
        $this->template->lastPage()->addImage('/dummy/image/second/path.png');

        $this->assertCount(2, $this->template->lastPage()->getImages());
        $this->assertInstanceOf(Collection::class, $this->template->lastPage()->getImages());
    }

    /** @test */
    function with_position()
    {
        $this->template->lastPage()->addImage('/dummy/image/path.jpg', 1, 2, 3, 4);

        $html = $this->template->render()->toHtml();
        $this->assertStringContainsString('top : 1px;', $html);
        $this->assertStringContainsString('right : 2px;', $html);
        $this->assertStringContainsString('bottom : 3px;', $html);
        $this->assertStringContainsString('left : 4px;', $html);
    }
}
