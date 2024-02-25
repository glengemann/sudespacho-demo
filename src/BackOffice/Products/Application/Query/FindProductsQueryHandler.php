<?php

namespace App\BackOffice\Products\Application\Query;

use App\BackOffice\Products\Domain\Repository\ProductRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FindProductsQueryHandler
{
    public function __construct(private ProductRepositoryInterface $productRepository)
    {
    }

    public function __invoke(FindProductsQuery $query)
    {
        return $this->productRepository->all();
    }
}