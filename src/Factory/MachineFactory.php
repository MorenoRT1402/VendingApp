<?php

namespace App\Factory;

use App\Entity\Machine;
use App\Repository\MachineRepository;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;
use Faker\Factory;

/**
 * @extends PersistentProxyObjectFactory<Machine>
 */
final class MachineFactory extends PersistentProxyObjectFactory{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Machine::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        $statusOptions = ['Active', 'Inactive', 'On Maintain'];
        $faker = Factory::create();

        return [
            'location' => $faker->city,
            'model' => $faker->word() . ' ' . $faker->randomNumber(3),
            'status' => $faker->randomElement($statusOptions),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Machine $machine): void {})
        ;
    }
}
