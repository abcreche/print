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

        return $this;
    }

    protected function setMilimeters($milimeters)
    {
        $this->milimeters = $milimeters;

        return $this;
    }

    protected function setInches($inches)
    {
        $this->inches = $inches;

        return $this;
    }

    public function toPixels()
    {
        return $this->pixels;
    }

    public function toMilimeters()
    {
        return $this->milimeters;
    }

    public function toInches()
    {
        return $this->inches;
    }
}
