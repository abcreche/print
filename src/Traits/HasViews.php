<?php

namespace ABCreche\Printer\Traits;

use ABCreche\Printer\Writing;
use ABCreche\Printer\Models\Image;
use Illuminate\Support\Collection;
use ABCreche\Printer\Models\PrintedView;

trait HasViews
{
    /**
     * An array of views which needs to be printed.
     */
    protected $views = [];

    /**
     * Adds an view in the views collection
     */
    public function addView(string $path, array $data = [], $top = 0, $right = 0, $bottom = 0, $left = 0)
    {
        $html = view($path, $data)->toHtml();
        $this->setViews(
            $this->getViews()
                ->push(
                    PrintedView::make($html, $top, $right, $bottom, $left)
                )
        );

        return $this;
    }

    public function getViews(): Collection
    {
        return collect($this->views);
    }

    protected function setViews($views)
    {
        $this->views = $views;
    }
}
