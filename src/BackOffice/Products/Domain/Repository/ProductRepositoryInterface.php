<?php

namespace App\BackOffice\Products\Domain\Repository;

use App\BackOffice\Products\Domain\Model\Product;
use App\Shared\Domain\Repository\RepositoryInterface;
use Doctrine\ORM\QueryBuilder;


interface ProductRepositoryInterface extends RepositoryInterface
{
    public function add(Product $product): void;

    public function all(): QueryBuilder;

    public function withName(QueryBuilder $qb, ?string $name): QueryBuilder;

    public function withPagination(QueryBuilder $qb, ?int $page, ?int $itemsPerPage): QueryBuilder;
}