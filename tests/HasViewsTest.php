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

        view()->addNamespace('printer-test', app_path('tests/Data/view'));
        dd(app_path('tests/Data/view'));
        $this->template = new EmptyPrintTemplate;
    }

    /** @test */
    function can_add_a_view()
    {
        dd(view('printer-test::dummy')->toHtml());

        $this->template->addView('printer-test::dummy');

        $this->assertCount(2, $this->template->getViews());
        $this->assertInstanceOf(Collection::class, $this->template->getImages());
    }

    /** @test */
    function with_position()
    {
        $this->template->addImage('/dummy/image/path.jpg', 1, 2, 3, 4);

        $html = $this->template->render()->toHtml();
        $this->assertStringContainsString('top : 1px;', $html);
        $this->assertStringContainsString('right : 2px;', $html);
        $this->assertStringContainsString('bottom : 3px;', $html);
        $this->assertStringContainsString('left : 4px;', $html);
    }
}