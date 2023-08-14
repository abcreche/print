<?php

namespace ABCreche\Printer;

class UnitConvert
{
    public ?int $pixels = null;
    public ?float $millimeters = null;
    public ?float $inches = null;

    // use 72 DPI dimensions

    public static function pixels($pixels): self
    {
        return (new self)->setPixels($pixels);
    }

    public static function millimeters($millimeters): self
    {
        return (new self)->setMillimeters($millimeters);
    }

    public static function inches($inches): self
    {
        return (new self)->setInches($inches);
    }

    protected function setPixels($pixels): self
    {
        $this->pixels = $pixels;

        return $this;
    }

    protected function setMillimeters($millimeters): self
    {
        $this->millimeters = $millimeters;

        return $this;
    }

    protected function setInches($inches): self
    {
        $this->inches = $inches;

        return $this;
    }

    public function toPixels(): string
    {
        return $this->prependUnit('px', function () {
            if ($this->millimeters) {
                return $this->millimeters * 595 / 210;
            }

            return $this->pixels;
        });
    }

    public function toMillimeters(): string
    {
        return $this->prependUnit('mm', function () {
            if (!is_null($this->inches)) {
                return $this->inches * 2.54 * 10;
            }
            if (!is_null($this->pixels)) {
                return $this->pixels / 595 * 210;
            }
            return $this->millimeters;
        });
    }

    public function toInches(): int
    {
        if ($this->millimeters) {
            return $this->millimeters / 25.4;
        }

        if (!is_null($this->pixels)) {
            return $this->pixels * 72;
        }

        return $this->inches;
    }

    public function prependUnit(string $unit, $callback): string
    {
        $digit = $callback();

        return $digit . $unit;
    }
}
