<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstname("Jane");
        $user->setLastname("Doe");
        $user->setEmail("j.doe@gmail.com");
        $user->setPassword(password_hash("123456", PASSWORD_DEFAULT));
        $manager->persist($user);

        $manager->flush();
    }
}
