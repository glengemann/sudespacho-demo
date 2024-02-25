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
        $qb = $this->productRepository->all();

        if (null !== $query->name) {
            $qb = $this
                ->productRepository->withName($qb, $query->name);
        }

        if (null !== $query->page) {
            $qb = $this
                ->productRepository->withPagination($qb, $query->page, $query->itemsPerPage);
        }

        return $qb->getQuery()->getResult();
    }
}