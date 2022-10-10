<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\WeatherItem;
use App\Dto\WeatherItems;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class WeatherstackService implements WeatherServiceInterface
{
    public function __construct(private WeatherstackApi $api) {}

    /**
     * @inheritDoc
     *
     * @throws NotFoundExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getWeather(string $city, array $dates): WeatherItems
    {
        // TODO Your current subscription plan does not support historical weather data
        // I use only current for this test task
        $response = $this->api->getCurrent($city);
        return $this->mapWeatherResponse($response);
    }

    protected function mapWeatherResponse(array $response): WeatherItems
    {
        return new WeatherItems(
            new ArrayCollection([
                new WeatherItem(
                    $response['location']['name'],
                    new DateTime(),
                    $response['current']['temperature'],
                    $response['current']['wind_speed'],
                )
            ])
        );
    }
}
