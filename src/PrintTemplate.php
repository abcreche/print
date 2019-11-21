<?php

namespace ABCreche\Printer;

use ABCreche\Printer\Traits\HasImages;
use ABCreche\Printer\Traits\HasStyles;
use ABCreche\Printer\Traits\HasWritings;
use ABCreche\Printer\Traits\HasOrientation;
use ABCreche\Printer\Traits\HasViews;
use Illuminate\Contracts\Support\Renderable;

abstract class PrintTemplate implements Renderable
{
    use HasStyles, HasWritings, HasImages, HasViews, HasOrientation;

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
    public function render()
    {
        $this->build();

        return view('print::layout')
            ->with('styles', $this->styles())
            ->with('pageMargin', $this->pageMargin)
            ->with('orientation', $this->orientation)
            ->with('images', $this->images)
            ->with('views', $this->views)
            ->with('writings', $this->writings);
    }

    public function build()
    {
        //
    }
}
