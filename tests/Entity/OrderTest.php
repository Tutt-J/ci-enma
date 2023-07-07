<?php

namespace App\Tests;

use App\Entity\User;
use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrderTest extends KernelTestCase
{
    public function testOrderEntity(): void
    {
        $user = new User();
        $user->setEmail("jane.doe@mail.com");

        $order = new Order();
        $order->setNumber("X698-2023");
        $order->setTotalPrice(2000);
        $order->setUser($user);

        $this->assertEquals("X698-2023", $order->getNumber());
        $this->assertEquals(2000, $order->getTotalPrice());
        $this->assertEquals("jane.doe@mail.com", $order->getUser()->getEmail());
    }
}
