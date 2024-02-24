<?php

namespace App\BackOffice\Products\Domain\Model;

use App\BackOffice\Products\Domain\ValueObject\Price;
use App\BackOffice\Products\Domain\ValueObject\ProductDescription;
use App\BackOffice\Products\Domain\ValueObject\ProductId;
use App\BackOffice\Products\Domain\ValueObject\ProductName;
use App\BackOffice\Products\Domain\ValueObject\Tax;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Embedded(columnPrefix: false)]
    private readonly ProductId $id;

    public function __construct(
        #[ORM\Embedded(columnPrefix: false)]
        private ProductName $name,

        #[ORM\Embedded(columnPrefix: false)]
        private ProductDescription $description,

        #[ORM\Embedded(columnPrefix: false)]
        private Price $price,

        #[ORM\Embedded(columnPrefix: false)]
        private Tax $tax,
    ) {
    }

    #[ORM\Column]
    private ?int $priceIncludingTax = null;

    public function id(): ProductId
    {
        return $this->id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function description(): ProductDescription
    {
        return $this->description;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function tax(): Tax
    {
        return $this->tax;
    }

    public function priceIncludingTax(): ?int
    {
        return $this->priceIncludingTax;
    }

    public function calculateTotal(): void
    {
        $this->priceIncludingTax = $this->price->price + $this->tax->tax;
    }
}
