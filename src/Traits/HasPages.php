<?php

namespace ABCreche\Printer\Traits;

use ABCreche\Printer\Models\Page;
use Illuminate\Support\Collection;

trait HasPages
{
    /**
     * Collection of Pages
     */
    protected array $pages = [];

    /**
     * Add a new page in the pages collection
     */
    public function addPage(): self
    {
        $this->setPages(
            $this->getPages()
                ->push(
                    new Page
                )
        );

        return $this;
    }

    public function getPagesCount(): int
    {
        return $this->getPages()->count();
    }

    public function firstPage(): ?Page
    {
        return $this->getPages()->first();
    }

    public function lastPage(): ?Page
    {
        return $this->getPages()->last();
    }

    public function getPages(): Collection
    {
        return collect($this->pages);
    }

    protected function setPages(Collection $pages): void
    {
        $this->pages = $pages->toArray();
    }
}
