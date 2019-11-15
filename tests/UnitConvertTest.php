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
        $this->assertEquals(255, UnitConvert::milimeters(90)->toPixels());
    }
}
