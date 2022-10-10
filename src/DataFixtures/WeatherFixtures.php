<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Factory\WeatherFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WeatherFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        WeatherFactory::createMany(10);
    }
}
