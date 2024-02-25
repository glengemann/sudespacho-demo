<?php

namespace App\BackOffice\Products\Infrastructure\ApiPlatform\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\BackOffice\Products\Application\Query\FindProductsQuery;
use App\BackOffice\Products\Infrastructure\ApiPlatform\Resource\ProductResource;
use App\Shared\Application\Query\QueryBusInterface;

class ProductCollectionProvider implements ProviderInterface
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        $products =  $this->queryBus->ask(new FindProductsQuery());

        $resources = [];
        foreach ($products as $product) {
            $resources[] = ProductResource::fromModel($product);
        }

        return $resources;
    }
}