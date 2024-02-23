<?php

namespace App\EventListener;

use App\Entity\Product;
use App\Services\CalculatePriceIncludingTax;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: 'preFlush', method: 'onPreFlush', entity: Product::class)]
final readonly class ProductPriceIncludingTaxListener
{
    public function __construct(private CalculatePriceIncludingTax $calculatePrice)
    {
    }

    public function onPreFlush(Product $event): void
    {
        $priceIncludingTax = $this->calculatePrice->calculate($event);

        $event->setPriceIncludingTax($priceIncludingTax);
    }
}
