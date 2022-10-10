<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\WeatherItems;
use DateTime;

interface WeatherServiceInterface
{
    /**
     * @param string $city
     * @param array<int, DateTime> $dates
     * @return WeatherItems
     */
    public function getWeather(string $city, array $dates): WeatherItems;
}
