<?php

namespace ABCreche\Printer;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Renderable;

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
                    Writing::make($text, $top, $right, $bottom, $left)
                )
        );

        return $this;
    }

    public function top($position, $unit = 'pixels')
    {
        $writing = $this->lastWriting();
        $writing->top($position);

        $this->replaceLastWriting($writing);

        return $this;
    }

    public function right($position, $unit = 'pixels')
    {
        $writing = $this->lastWriting();
        $writing->right($position);

        $this->replaceLastWriting($writing);

        return $this;
    }

    public function bottom($position, $unit = 'pixels')
    {
        $writing = $this->lastWriting();
        $writing->bottom($position);

        $this->replaceLastWriting($writing);

        return $this;
    }

    public function left($position, $unit = 'pixels')
    {
        $writing = $this->lastWriting();
        $writing->left($position);

        $this->replaceLastWriting($writing);

        return $this;
    }

    public function getWritings(): Collection
    {
        return collect($this->writings);
    }

    protected function setWritings($writings)
    {
        $this->writings = $writings;
    }

    protected function lastWriting(): Writing
    {
        return $this->getWritings()->last();
    }

    protected function replaceLastWriting(Writing $writing)
    {
        $writings = $this->getWritings();
        $writings->pop();

        $writings->push($writing);

        $this->setWritings($writings);
    }

    /**
     * Render the print temple into a view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->build();

        return view('print::layout')
            ->with('orientation', $this->orientation)
            ->with('writings', $this->writings);
    }

    public function build()
    {
        //
    }
}
