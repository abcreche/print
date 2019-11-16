<?php

namespace ABCreche\Printer\Test;

use ABCreche\Printer\UnitConvert;

class UnitConvertTest extends TestCase
{
    /** @test */
    function instanciate_converter()
    {
        $this->assertInstanceOf(UnitConvert::class, UnitConvert::milimeters(0));
        $this->assertInstanceOf(UnitConvert::class, UnitConvert::pixels(0));
        $this->assertInstanceOf(UnitConvert::class, UnitConvert::inches(0));
    }

    /** @test */
    public function milimeter_to_pixels()
    {
        $this->assertEquals(595, UnitConvert::milimeters(210)->toPixels());
    }

    /** @test */
    public function pixels_to_milimeters()
    {
        $this->assertEquals(210, UnitConvert::pixels(595)->toMilimeters());
    }

    /** @test */
    public function milimeter_to_inches()
    {
        $this->assertEquals(25.4, UnitConvert::inches(1)->toMilimeters());
    }
}
