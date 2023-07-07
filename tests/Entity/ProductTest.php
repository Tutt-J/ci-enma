<?php

namespace App\Tests;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductTest extends KernelTestCase
{
    public function testProductEntity(): void
    {
        $product = new Product();
        $product->setName("Iphone");
        $product->setPrice(1000);

        $this->assertEquals("Iphone", $product->getName());
        $this->assertEquals(1000, $product->getPrice());
    }
}
