<?php

namespace App\BackOffice\Products\Application\Event;

use App\BackOffice\Products\Domain\Model\Product;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: 'preFlush', method: 'onPreFlush', entity: Product::class)]
final readonly class ProductPriceIncludingTaxListener
{
    public function onPreFlush(Product $product): void
    {
        $product->calculateTotal();
    }
}
