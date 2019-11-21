<?php

namespace ABCreche\Printer\Traits;

use Illuminate\Support\Collection;

trait HasStyles
{
    protected $styles = [];

    /**
     * Add one style rule to the styles array
     */
    public function style($attribute, $property = null)
    {
        if (is_array($attribute)) {
            foreach ($attribute as $key => $property) {
                $this->styles[$key] = $property;
            }
        } else {
            $this->styles[$attribute] = $property;
        }

        return $this;
    }

    /**
     * Get the styles as a Collection
     *
     * @return Collection
     */
    public function styles(): Collection
    {
        return collect($this->styles);
    }
}
