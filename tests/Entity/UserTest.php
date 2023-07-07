<?php

namespace App\Tests;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testUserEntity(): void
    {
        $user = new User();
        $user->setFirstname("Jane");
        $user->setLastname("Doe");
        $user->setEmail("jane.doe@mail.com");
        $user->setPassword("123456");
        $user->setRoles(["ROLE_USER"]);

        $this->assertEquals("Doe", $user->getLastname());
        $this->assertEquals("Jane", $user->getFirstname());
        $this->assertEquals("jane.doe@mail.com", $user->getEmail());
        $this->assertEquals("jane.doe@mail.com", $user->getUserIdentifier());
        $this->assertEquals("123456", $user->getPassword());
        $this->assertContains("ROLE_USER", $user->getRoles());
    }
}
