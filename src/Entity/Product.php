<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Enums\Tax;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            security: 'is_granted("PUBLIC_ACCESS")',
        ),
        new Post(
            denormalizationContext: [
                'groups' => ['product:write'],
            ],
            security: 'is_granted("IS_AUTHENTICATED")',
        ),
    ],
)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    #[Assert\NotBlank]
    #[Groups(['product:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Groups(['product:write'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(['product:write'])]
    private ?int $price = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(['product:write'])]
    private Tax $tax;

    #[ORM\Column]
    private ?int $priceIncludingTax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getTax(): Tax
    {
        return $this->tax;
    }

    public function setTax(Tax $tax): static
    {
        $this->tax = $tax;

        return $this;
    }

    public function getPriceIncludingTax(): ?int
    {
        return $this->priceIncludingTax;
    }

    public function setPriceIncludingTax(int $priceIncludingTax): static
    {
        $this->priceIncludingTax = $priceIncludingTax;

        return $this;
    }
}
