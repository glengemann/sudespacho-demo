<?php

namespace App\BackOffice\Products\Infrastructure\Doctrine;

use App\BackOffice\Products\Domain\Model\Product;
use App\BackOffice\Products\Domain\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class DoctrineProductRepository implements ProductRepositoryInterface
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function add(Product $product): void
    {
        $this->em->persist($product);
        $this->em->flush();
    }

    public function all(): QueryBuilder
    {
        return $this->em->createQueryBuilder()
            ->select('products')
            ->from(Product::class, 'products');
    }

    public function withName(QueryBuilder $qb, ?string $name): QueryBuilder
    {
        $qb
            ->andWhere($qb->expr()->like('products.name.name', ':name'))
            ->setParameter('name', '%' . $name . '%');

        return $qb;
    }

    public function withPagination(QueryBuilder $qb, ?int $page, ?int $itemsPerPage): QueryBuilder
    {
        $qb
            ->setFirstResult(($page - 1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage);

        return $qb;
    }
}