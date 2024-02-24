<?php

namespace App\Services;

use App\Entity\Product;

class CalculatePriceIncludingTax
{
    public function calculate(Product $product): int
    {
        return $product->getPrice() + $product->getTax()->value;
    }
}