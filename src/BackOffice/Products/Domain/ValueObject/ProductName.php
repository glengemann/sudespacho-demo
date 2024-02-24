<?php

namespace App\BackOffice\Products\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class ProductName
{
    #[ORM\Column(length: 20)]
    public readonly string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}