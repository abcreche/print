<?php

namespace ABCreche\Printer\Test;

use ABCreche\Printer\Printer;
use ABCreche\Printer\Test\Data\Stubs\EmptyPrintTemplate;
use Illuminate\Support\Collection;

class HasViewsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        view()->addNamespace('printer-test', dirname(__FILE__) . '/Data/views');
        $this->template = new EmptyPrintTemplate;
        $this->template->addPage();
    }

    /** @test */
    function can_add_a_view()
    {
        $this->template->lastPage()->addView('printer-test::dummy');

        $this->assertCount(1, $this->template->lastPage()->getViews());
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
