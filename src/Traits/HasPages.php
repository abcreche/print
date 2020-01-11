<?php

namespace ABCreche\Printer\Traits;

use ABCreche\Printer\Models\Page;
use Illuminate\Support\Collection;

trait HasPages
{
    /**
     * Collection of Pages
     */
    protected $pages = [];

    /**
     * Add a new page in the pages collection
     */
    public function addPage()
    {
        $this->setPages(
            $this->getPages()
                ->push(
                    new Page
                )
        );

        return $this;
    }

    public function getPagesCount()
    {
        return $this->getPages()->count();
    }

    public function firstPage()
    {
        return $this->getPages()->first();
    }

    public function lastPage()
    {
        return $this->getPages()->last();
    }

    public function getPages(): Collection
    {
        return collect($this->pages);
    }

    protected function setPages($pages)
    {
        $this->pages = $pages;
    }
}
