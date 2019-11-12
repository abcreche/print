<?php

namespace ABCreche\Printer;

class UnitConvert
{
    public static function pixels($pixels)
    {
        return (new self)->setPixels($pixels);
    }

    public static function milimeters($milimeters)
    {
        return (new self)->setMilimeters($milimeters);
    }

    public static function inches($inches)
    {
        return (new self)->setInches($inches);
    }

    protected function setPixels($pixels)
    {
        $this->pixels = $pixels;
    }

    protected function setMilimeters($milimeters)
    {
        $this->milimeters = $milimeters;
    }

    protected function setInches($inches)
    {
        $this->inches = $inches;
    }
}
