<?php

namespace ABCreche\Printer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;

abstract class PrintTemplate implements Renderable
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

        return $this;
    }

    public function top($position, $unit = 'pixels')
    {
        $writings = $this->getWritings();
        $last = $writings->last();
        $last['top'] = $position;
        $writings->pop();
        $this->setWritings(
            $writings->push($last)->toArray()
        );

        return $this;
    }

    public function right($position, $unit = 'pixels')
    {
        $writings = $this->getWritings();
        $last = $writings->last();
        $last['right'] = $position;
        $writings->pop();
        $this->setWritings(
            $writings->push($last)->toArray()
        );

        return $this;
    }

    public function bottom($position, $unit = 'pixels')
    {
        $writings = $this->getWritings();
        $last = $writings->last();
        $last['bottom'] = $position;
        $writings->pop();
        $this->setWritings(
            $writings->push($last)->toArray()
        );

        return $this;
    }

    public function left($position, $unit = 'pixels')
    {
        $writings = $this->getWritings();
        $last = $writings->last();
        $last['left'] = $position;
        $writings->pop();
        $this->setWritings(
            $writings->push($last)->toArray()
        );

        return $this;
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
        return UnitConvert::pixels($unit)->toMilimeters();
    }

    /**
     * Render the print temple into a view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layout');
    }
}
