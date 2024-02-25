<?php

namespace App\Tests\BackOffice\Products\Domain\Model;

use App\BackOffice\Products\Domain\Model\Product;
use App\BackOffice\Products\Domain\ValueObject\Price;
use App\BackOffice\Products\Domain\ValueObject\ProductDescription;
use App\BackOffice\Products\Domain\ValueObject\ProductName;
use App\BackOffice\Products\Domain\ValueObject\Tax;
use App\BackOffice\Products\Domain\Enums\Tax as TaxEnum;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductCanBeCreated(): void
    {
        $product = new Product(
            new ProductName('Product name'),
            new ProductDescription('Product description'),
            new Price(1000),
            new Tax(TaxEnum::LOW)
        );

        $product->calculateTotal();

        $this->assertEquals('Product name', $product->name());
        $this->assertEquals('Product description', $product->description());
        $this->assertEquals(1000, $product->price()->price);
        $this->assertEquals(TaxEnum::LOW, $product->tax()->tax);
        $this->assertEquals(1004, $product->priceIncludingTax());
    }
}