<?php

namespace ABCreche\Printer\Test;

use ABCreche\Printer\UnitConvert;

class UnitConvertTest extends TestCase
{
    /** @test */
    function instanciate_converter()
    {
        $this->assertInstanceOf(UnitConvert::class, UnitConvert::millimeters(0));
        $this->assertInstanceOf(UnitConvert::class, UnitConvert::pixels(0));
        $this->assertInstanceOf(UnitConvert::class, UnitConvert::inches(0));
    }

    /** @test */
    public function millimeter_to_pixels()
    {
        $this->assertEquals('595px', UnitConvert::millimeters(210)->toPixels());
    }

    /** @test */
    public function pixels_to_millimeters()
    {
        $this->assertEquals('210mm', UnitConvert::pixels(595)->toMillimeters());
    }

    /** @test */
    public function inches_to_millimeters()
    {
        $this->assertEquals('25.4mm', UnitConvert::inches(1)->toMillimeters());
    }

    /** @test */
    public function millimeter_to_inches()
    {
        $this->assertEquals(1, UnitConvert::millimeters(25.4)->toInches());
    }
}
