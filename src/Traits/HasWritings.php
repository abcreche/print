<?php

namespace ABCreche\Printer\Traits;

use Illuminate\Support\Collection;
use ABCreche\Printer\Models\Writing;

trait HasWritings
{
    /**
     * An array of texts which needs to be printed.
     */
    protected array $writings = [];

    /**
     * Adds some text in the writings collection
     */
    public function write($text = null, $top = null, $right = null, $bottom = null, $left = null, array $styles = []): self
    {
        if ($text) {
            $this->setWritings(
                $this->getWritings()
                    ->push(
                        Writing::make($text, $top, $right, $bottom, $left, $styles)
                    )
            );
        }

        return $this;
    }

    public function top($position, $unit = 'pixels'): self
    {
        $writing = $this->lastWriting();
        $writing->top($position);

        $this->replaceLastWriting($writing);

        return $this;
    }

    public function right($position, $unit = 'pixels'): self
    {
        $writing = $this->lastWriting();
        $writing->right($position);

        $this->replaceLastWriting($writing);

        return $this;
    }

    public function bottom($position, $unit = 'pixels'): self
    {
        $writing = $this->lastWriting();
        $writing->bottom($position);

        $this->replaceLastWriting($writing);

        return $this;
    }

    public function left($position, $unit = 'pixels'): self
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

    protected function setWritings(Collection $writings): void
    {
        $this->writings = $writings->toArray();
    }

    protected function lastWriting(): Writing
    {
        return $this->getWritings()->last();
    }

    protected function replaceLastWriting(Writing $writing): void
    {
        $writings = $this->getWritings();
        $writings->pop();

        $writings->push($writing);

        $this->setWritings($writings);
    }
}
