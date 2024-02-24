<?php

namespace App\BackOffice\Products\Application\Command;

use App\BackOffice\Products\Domain\ValueObject\Price;
use App\BackOffice\Products\Domain\ValueObject\ProductDescription;
use App\BackOffice\Products\Domain\ValueObject\ProductName;
use App\BackOffice\Products\Domain\ValueObject\Tax;
use App\Shared\Command\CommandInterface;

final readonly class CreateProductCommand implements CommandInterface
{
    public function __construct(
        public ProductName $name,
        public ProductDescription $description,
        public Price $price,
        public Tax $tax,
    ) {
    }
}