<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\WeatherItems;

class WeatherstackService implements WeatherServiceInterface
{
    /**
     * @inheritDoc
     */
    public function getWeather(string $city, array $dates): WeatherItems
    {
        // TODO: Implement getWeather() method.
    }
}
