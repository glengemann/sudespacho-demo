<?php

namespace App\BackOffice\Products\Infrastructure\Doctrine;

use App\BackOffice\Products\Domain\Model\Product;
use App\BackOffice\Products\Domain\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

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
}