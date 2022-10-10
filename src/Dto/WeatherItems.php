<?php

declare(strict_types=1);

namespace App\Dto;

use Doctrine\Common\Collections\Collection;

class WeatherItems
{
    /**
     * @var Collection<int, WeatherItem>
     */
    public Collection $items;
}
