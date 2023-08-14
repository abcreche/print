<?php

namespace ABCreche\Printer\Traits;

use ABCreche\Printer\Models\Image;
use ABCreche\Printer\Writing;
use Illuminate\Support\Collection;

trait HasImages
{
    /**
     * An array of image which needs to be printed.
     */
    protected array $images = [];

    /**
     * Adds an image in the images collection
     */
    public function addImage(string $path, $top = 0, $right = 0, $bottom = 0, $left = 0): self
    {
        $this->setImages(
            $this->getImages()
                ->push(
                    Image::make($path, $top, $right, $bottom, $left)
                )
        );

        return $this;
    }

    public function getImages(): Collection
    {
        return collect($this->images);
    }

    protected function setImages(Collection $images): void
    {
        $this->images = $images->toArray();
    }
}
