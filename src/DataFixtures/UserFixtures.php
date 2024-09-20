<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\LoginTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserFixtures extends Fixture
{

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $hashedPassword = $this->passwordHasher->hashPassword($user, 'test');

        $user
            ->setEmail('test@test.com')
            ->setName('Test')
            ->setSurname('Test')
            ->setPassword('test')
            ->setUserName('test')
            ->setPassword($hashedPassword)
            ->setLoginType(LoginTypeEnum::EMAIL);

        $manager->persist($user);
        $manager->flush();
    }
}