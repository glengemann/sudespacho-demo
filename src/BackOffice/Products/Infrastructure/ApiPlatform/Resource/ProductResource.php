<?php

namespace App\BackOffice\Products\Infrastructure\ApiPlatform\Resource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\BackOffice\Products\Domain\Model\Product;
use App\BackOffice\Products\Infrastructure\ApiPlatform\State\Processor\CreateProductProcessor;
use App\BackOffice\Products\Infrastructure\ApiPlatform\State\Provider\ProductCollectionProvider;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ApiResource(
    shortName: 'Product',
    operations: [
        new GetCollection(
            security: 'is_granted("PUBLIC_ACCESS")',
            provider: ProductCollectionProvider::class,
        ),
        new Post(
            denormalizationContext: [
                'groups' => ['product:write'],
            ],
            // TODO
            //security: 'is_granted("IS_AUTHENTICATED")',
            processor: CreateProductProcessor::class
        ),
    ],
)]
final class ProductResource
{
    public function __construct(
        #[ApiProperty(identifier: true, readable: false, writable: false)]
        public ?int $id = null,

        #[ApiFilter(SearchFilter::class, strategy: 'partial')]
        #[Assert\NotBlank]
        #[Groups(['product:write'])]
        public ?string $name = null,

        #[Assert\NotBlank]
        #[Groups(['product:write'])]
        public ?string $description = null,

        #[Assert\NotBlank]
        #[Groups(['product:write'])]
        public ?int $price = null,

        #[Assert\NotBlank]
        #[Groups(['product:write'])]
        public ?int $tax = null,

        #[ApiProperty(readable: true, writable: false)]
        public ?int $priceIncludingTax = null,
    ) {
    }

    public static function fromModel(Product $product): ProductResource
    {
        return new self(
            $product->id()->id,
            $product->name(),
            $product->description(),
            $product->price()->price,
            $product->tax()->tax,
            $product->priceIncludingTax(),
        );
    }
}