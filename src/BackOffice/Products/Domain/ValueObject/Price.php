<?php

namespace App\BackOffice\Products\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Price
{
    #[ORM\Column]
    public readonly int $price;

    public function __construct(int $price)
    {
        $this->price = $price;
    }
}