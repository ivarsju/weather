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
        $response = $this->client->request(
            'GET',
            sprintf(
                '%s%s?access_key=%s&query=%s',
                $this->params->get('app.weatherstack.url'),
                $path,
                $this->params->get('app.weatherstack.token'),
                urlencode($city)
            )
        );

        return $response->getContent();
    }
}
