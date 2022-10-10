<?php

declare(strict_types=1);

namespace App\Services;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherstackApi
{
    public function __construct(
        protected ContainerBagInterface $params,
        protected HttpClientInterface $client
    ) {}

    public function getHistorical(string $city, string $dates)
    {
        // TODO
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getCurrent(string $city): array
    {
        return json_decode($this->makeRequest($city, '/current'), true);
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     */
    protected function makeRequest(string $city, string $path): string
    {
        return '{
            "request": {
                "type": "City",
                "query": "Riga, Latvia",
                "language": "en",
                "unit": "m"
            },
            "location": {
                "name": "Riga",
                "country": "Latvia",
                "region": "Riga",
                "lat": "56.950",
                "lon": "24.100",
                "timezone_id": "Europe/Riga",
                "localtime": "2022-10-10 14:42",
                "localtime_epoch": 1665412920,
                "utc_offset": "3.0"
            },
            "current": {
                "observation_time": "11:42 AM",
                "temperature": 13,
                "weather_code": 116,
                "weather_icons": [
                    "https://assets.weatherstack.com/images/wsymbols01_png_64/wsymbol_0002_sunny_intervals.png"
                ],
                "weather_descriptions": [
                    "Partly cloudy"
                ],
                "wind_speed": 15,
                "wind_degree": 210,
                "wind_dir": "SSW",
                "pressure": 1024,
                "precip": 0,
                "humidity": 67,
                "cloudcover": 50,
                "feelslike": 12,
                "uv_index": 4,
                "visibility": 10,
                "is_day": "yes"
            }
        }';
    }
}
