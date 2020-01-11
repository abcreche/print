<?php

namespace ABCreche\Printer;

use Illuminate\View\View;
use ABCreche\Printer\Traits\HasPages;
use ABCreche\Printer\Traits\HasViews;
use ABCreche\Printer\Traits\HasImages;
use ABCreche\Printer\Traits\HasStyles;
use ABCreche\Printer\Traits\HasWritings;
use ABCreche\Printer\Traits\HasOrientation;
use Illuminate\Contracts\Support\Renderable;

abstract class PrintTemplate implements Renderable
{
    use HasStyles, HasPages, HasOrientation;

    public $pageMargin;

    public function serif()
    {
        $this->style('font-family', 'serif');

        return $this;
    }

    public function sansSerif()
    {
        $this->style('font-family', 'sans-serif');

        return $this;
    }

    public function margins(int $pixels)
    {
        $this->pageMargin = $pixels;

        return $this;
    }

    /**
     * Render the print temple into a view.
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        $this->addPage(); // Always have at least one page

        $this->build();

        return view('print::layout')
            ->with('styles', $this->styles())
            ->with('pageMargin', $this->pageMargin)
            ->with('orientation', $this->orientation)
            ->with('pages', $this->getPages());
    }

    public function build()
    {
        //
    }
}
