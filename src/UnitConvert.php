<?php

namespace ABCreche\Printer;

class UnitConvert
{
    public $pixels;
    public $milimeters;
    public $inches;

    // use 72 DPI dimensions

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
        if ($this->milimeters) {
            return $this->milimeters * 595 / 210;
        }
    }

    public function toMilimeters()
    {
        if (!is_null($this->inches)) {
            return $this->inches * 2.54 * 10;
        }
        if (!is_null($this->pixels)) {
            return $this->pixels / 595 * 210;
        }
        return $this->milimeters;
    }

    public function toInches()
    {
        if ($this->milimeters) {
            return $this->milimeters / 25.4;
        }

        if (!is_null($this->pixels)) {
            return $this->pixels * 72;
        }

        return $this->inches;
    }
}
