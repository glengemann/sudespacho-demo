<?php

namespace App\BackOffice\Products\Infrastructure\ApiPlatform\Resource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\BackOffice\Products\Domain\Model\Product;
use App\BackOffice\Products\Infrastructure\ApiPlatform\ApenApi\NameFilter;
use App\BackOffice\Products\Infrastructure\ApiPlatform\State\Processor\CreateProductProcessor;
use App\BackOffice\Products\Infrastructure\ApiPlatform\State\Provider\ProductCollectionProvider;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'Product',
    operations: [
        new GetCollection(
            security: 'is_granted("PUBLIC_ACCESS")',
            filters: [NameFilter::class], // TODO
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