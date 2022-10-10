<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\WeatherRepository;
use DateTime;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;

class WeatherController extends AbstractFOSRestController
{
    /**
     * @throws Exception
     */
    #[Rest\Get('/weather/{city}/{dateFrom}/{dateTo}', name: 'app_weather')]
    public function index(
        string $city,
        string $dateFrom,
        string $dateTo,
        WeatherRepository $repository
    ): JsonResponse
    {
        return $this->json($repository->findByCityAndDateRange(
            $city,
            new DateTime($dateFrom),
            new DateTime($dateTo),
        ));
    }
}
