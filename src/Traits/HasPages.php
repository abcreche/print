<?php

namespace ABCreche\Printer\Traits;

use ABCreche\Printer\Writing;
use Illuminate\Support\Collection;

trait HasPages
{
    /**
     * Count of pages
     */
    protected $pageCount = 1;

    /**
     * Increment the page count
     */
    public function addPage()
    {
        $this->pageCount++;

        return $this;
    }

    public function getPagesCount()
    {
        return $this->pageCount;
    }

    public function getPages(): Collection
    {
        return collect(range(1, $this->pageCount));
    }

    protected function setPagesCount($count)
    {
        $this->pageCount = $count;
    }
}
