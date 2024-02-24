<?php

namespace App\BackOffice\Products\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class ProductDescription
{
    #[ORM\Column(length: 255)]
    public readonly string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function __toString(): string
    {
        return $this->description;
    }
}