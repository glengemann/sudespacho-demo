<?php

namespace App\BackOffice\Products\Domain\Repository;

use App\BackOffice\Products\Domain\Model\Product;
use App\Shared\Domain\Repository\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function add(Product $product): void;
}