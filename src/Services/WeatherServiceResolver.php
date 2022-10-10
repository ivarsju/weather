<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\Source;

class WeatherServiceResolver
{
    public function __construct(private WeatherstackService $weatherstackService) {}

    public function getWeatherService(Source $source): WeatherServiceInterface
    {
        // TODO create service pool/CompilerPass
        return match ($source) {
            Source::WEATHERSTACK => $this->weatherstackService,
        };
    }
}
