<?php

namespace ABCreche\Printer\Test;

use ABCreche\Printer\Printer;
use ABCreche\Printer\Test\Data\Stubs\EmptyPrintTemplate;
use Illuminate\Support\Collection;

class HasStylesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->template = new EmptyPrintTemplate;
    }

    /** @test */
    function can_add_one_style()
    {
        $this->template->style('attr', 'prop');

        $this->assertCount(1, $this->template->styles());
        $this->assertInstanceOf(Collection::class, $this->template->styles());
    }

    /** @test */
    function can_add_several_styles()
    {
        $this->template->style('attr', 'prop');
        $this->template->style('font', 'something');

        $this->assertCount(2, $this->template->styles());
    }

    /** @test */
    function can_override_a_specific_style()
    {
        $this->template->style('attr', 'prop');
        $this->template->style('attr', 'something');

        $this->assertCount(1, $this->template->styles());
        $this->assertEquals('something', $this->template->styles()->first());
    }

    /** @test */
    function can_add_several_styles_at_once()
    {
        $this->template->style([
            'attr' => 'prop',
            'font' => 'something',
        ]);

        $this->assertCount(2, $this->template->styles());
        $this->assertEquals('something', $this->template->styles()->last());
    }
}
