<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Entity\Weather;
use App\Message\GetWeather;
use App\Repository\WeatherRepository;
use App\Services\WeatherServiceResolver;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetWeatherHandler
{
    public function __construct(
        private WeatherServiceResolver $serviceResolver,
        private WeatherRepository $repository,
    ) {}

    public function __invoke(GetWeather $message)
    {
        $dates = explode(',', $message->getDates());

        $weatherService = $this->serviceResolver->getWeatherService($message->getSource());
        $weatherData = $weatherService->getWeather($message->getCity(), $dates);
        foreach ($weatherData->getItems() as $item) {
            $this->repository->save(
                (new Weather())
                    ->setCity($item->getCity())
                    ->setDate($item->getDate())
                    ->setTemperature($item->getTemperature())
                    ->setWindSpeed($item->getWindSpeed()),
                true
            );
        }
    }
}
