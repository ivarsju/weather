<?php

declare(strict_types=1);

namespace App\Dto;

use Doctrine\Common\Collections\Collection;

class WeatherItems
{
    /**
     * @param Collection<int, WeatherItem> $items
     */
    public function __construct(private Collection $items) {}

    /**
     * @return Collection<int, WeatherItem>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }
}
