<?php

declare(strict_types=1);

namespace App\Message;

use App\Enum\Source;

class GetWeather
{
    /**
     * @param Source $source
     * @param string $city
     * @param string $dates comma seperated dates, e.g. 2022-10-09,2022-10-10...
     */
    public function __construct(
        private readonly Source $source,
        private readonly string $city,
        private readonly string $dates,
    ) {}

    public function getSource(): Source
    {
        return $this->source;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getDates(): string
    {
        return $this->dates;
    }
}
