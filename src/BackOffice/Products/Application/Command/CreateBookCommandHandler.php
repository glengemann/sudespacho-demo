<?php

namespace App\BackOffice\Products\Application\Command;

use App\BackOffice\Products\Domain\Model\Product;
use App\BackOffice\Products\Domain\Repository\ProductRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateBookCommandHandler
{
    public function __construct(private ProductRepositoryInterface $productRepository)
    {
    }

    public function __invoke(CreateProductCommand $command): Product
    {
        $product = new Product(
            $command->name,
            $command->description,
            $command->price,
            $command->tax
        );

        $product->calculateTotal();

        $this->productRepository->add($product);

        return $product;
    }
}