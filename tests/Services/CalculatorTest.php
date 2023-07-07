<?php

namespace App\Tests;

use App\Entity\Product;
use App\Services\Calculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalculatorTest extends KernelTestCase
{
    public function testGetTotalHT(): void
    {
        $calculator = new Calculator();
        $totalHT = $calculator->getTotalHT($this->getProducts());

        $this->assertEquals(101, $totalHT);
    }

    public function testGetTotalTTC(): void
    {
        $calculator = new Calculator();
        $totalTTC = $calculator->getTotalTTC($this->getProducts(), 20);

        $this->assertEquals(121.2, $totalTTC);
    }

    public function getProducts()
    {
        return [
            [
                'product' => $this->createProduct("Ballon rouge", 10),
                'quantity' => 3
            ],
            [
                'product' => $this->createProduct("Ballon bleu", 8),
                'quantity' => 2
            ],
            [
                'product' => $this->createProduct("Ballon jaune", 11),
                'quantity' => 5
            ]
        ];
    }

    public function createProduct($name, $price)
    {
        return ((new Product())
        ->setName($name)
        ->setPrice($price));
    }
}
