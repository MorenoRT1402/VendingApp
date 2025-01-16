<?php

namespace App\DataFixtures;

use App\Factory\MachineFactory;
use App\Factory\ProductFactory;
use App\Factory\StockFactory;
use App\Factory\UserFactory;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        MachineFactory::createMany(10);

        ProductFactory::createMany(20);

        StockFactory::createMany(50);
    }
}