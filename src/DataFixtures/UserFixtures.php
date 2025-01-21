<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\UserRoles;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    private ParameterBagInterface $params;

    public function __construct(UserPasswordHasherInterface $passwordHasher, ParameterBagInterface $params)
    {
        $this->passwordHasher = $passwordHasher;
        $this->params = $params;
    }

    public function load(ObjectManager $manager): void
    {
        $testUser = $this->params->get('test_user');

        // Admin
        $admin = new User();
        $admin->setEmail($testUser['email']);
        $admin->setRoles([UserRoles::ADMIN]);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            $testUser['password']
        );
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);

        // Faker
        UserFactory::createMany(10);

        $manager->flush();
    }
}
