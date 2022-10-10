<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Weather;
use App\Repository\WeatherRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Weather>
 *
 * @method static Weather|Proxy createOne(array $attributes = [])
 * @method static Weather[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Weather[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Weather|Proxy find(object|array|mixed $criteria)
 * @method static Weather|Proxy findOrCreate(array $attributes)
 * @method static Weather|Proxy first(string $sortedField = 'id')
 * @method static Weather|Proxy last(string $sortedField = 'id')
 * @method static Weather|Proxy random(array $attributes = [])
 * @method static Weather|Proxy randomOrCreate(array $attributes = [])
 * @method static Weather[]|Proxy[] all()
 * @method static Weather[]|Proxy[] findBy(array $attributes)
 * @method static Weather[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Weather[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static WeatherRepository|RepositoryProxy repository()
 * @method Weather|Proxy create(array|callable $attributes = [])
 */
final class WeatherFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'city' => self::faker()->city(),
            'date' => self::faker()->dateTime(),
            'temperature' => self::faker()->randomNumber(2),
            'windSpeed' => self::faker()->randomNumber(2),
            'createdAt' => self::faker()->dateTime(),
            'updatedAt' => self::faker()->dateTime()
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Weather $weather): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Weather::class;
    }
}
