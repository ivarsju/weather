<?php

declare(strict_types=1);

namespace App\Tests\Integration\Services;

use App\Services\WeatherstackApi;
use App\Services\WeatherstackService;
use App\Tests\Fakers\FakeWeatherstackApi;
use DateTime;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherstackServiceTest extends WebTestCase
{
    /**
     * @throws TransportExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function testWeatherRequest()
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var ContainerBagInterface $containerBag */
        $containerBag = $container->get(ContainerBagInterface::class);

        /** @var HttpClientInterface $client */
        $client = $container->get(HttpClientInterface::class);

        //$api = new WeatherstackApi($containerBag, $client);
        $api = new FakeWeatherstackApi($containerBag, $client);

        $service = new WeatherstackService($api);

        $response = $service->getWeather('riga', [new DateTime()]);
        $item = $response->getItems()->first();

        self::assertSame('Riga', $item->getCity());
        self::assertSame('2022-10-10', $item->getDate()->format('Y-m-d'));
        self::assertSame(13, $item->getTemperature());
        self::assertSame(15, $item->getWindSpeed());
    }
}
