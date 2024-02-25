<?php

namespace App\BackOffice\Products\Application\Query;

use App\Shared\Application\Query\QueryInterface;

class FindProductsQuery implements QueryInterface
{
    public function __construct(
        public ?string $name = null, // TODO: Use a value object
        public ?int $page = null,
        public ?int $itemsPerPage = 10,
    ) {
    }
}