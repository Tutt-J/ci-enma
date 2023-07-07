<?php

namespace App\Services;

class Calculator{
    public function getTotalHT(array $products){
        $total = 0;
        foreach($products as $product){
            $total+=$product['quantity']*$product["product"]->getPrice();
        }
        return $total;
    }

    public function getTotalTTC(array $products, int $tva){
        $totalHT=$this->getTotalHT($products);
        $totalTTC=$totalHT+($totalHT*$tva/100);
        return $totalTTC;
    }
}