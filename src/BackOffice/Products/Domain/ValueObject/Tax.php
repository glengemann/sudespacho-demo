<?php

namespace App\BackOffice\Products\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Tax
{
    #[ORM\Column]
    public readonly int $tax; // TODO: Enum?

    public function __construct(int $tax)
    {
        $this->tax = $tax;
    }
}