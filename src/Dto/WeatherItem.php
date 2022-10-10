<?php

declare(strict_types=1);

namespace App\Dto;

use DateTime;

class WeatherItem
{
    public function __construct(
        private readonly string   $city,
        private readonly DateTime $date,
        private readonly int      $temperature,
        private readonly int      $windSpeed
    ) {}

    public function getCity(): string
    {
        return $this->city;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getTemperature(): int
    {
        return $this->temperature;
    }

    public function getWindSpeed(): int
    {
        return $this->windSpeed;
    }
}
