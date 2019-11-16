<?php

namespace ABCreche\Printer;

use Illuminate\Support\Collection;

abstract class PrintTemplate
{
    /**
     * Defines the orientation of the page when being printed
     */
    protected $orientation = 'portrait';

    /**
     * An array of texts which needs to be printed.
     */
    protected $writings = [];

    /**
     * Adds some text in the writings collection
     */
    public function write(string $text, $top = 0, $right = 0, $bottom = 0, $left = 0)
    {
        $this->setWritings(
            $this->getWritings()
                ->push(
                    $this->makeWriting($text, $top, $right, $bottom, $left)
                )
                ->toArray()
        );
    }

    public function top($position)
    {
        # code...
    }

    public function right($position)
    {
        # code...
    }

    public function bottom($position)
    {
        # code...
    }

    public function left($position)
    {
        # code...
    }

    public function getWritings(): Collection
    {
        return collect($this->writings);
    }

    protected function setWritings(array $writings)
    {
        $this->writings = $writings;
    }

    protected function makeWriting(string $text, $top = 0, $right = 0, $bottom = 0, $left = 0): array
    {
        return [
            'text' => $text,
            'top' => $this->convertUnit($top),
            'right' => $this->convertUnit($right),
            'bottom' => $this->convertUnit($bottom),
            'left' => $this->convertUnit($left),
        ];
    }

    /**
     * Convert any unit to milimeter
     */
    protected function convertUnit($unit)
    {
        return UnitConvert::pixel($unit)->toMilimeters();
    }
}
