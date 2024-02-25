<?php

namespace App\BackOffice\Products\Infrastructure\ApiPlatform\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\BackOffice\Products\Application\Command\CreateProductCommand;
use App\BackOffice\Products\Domain\Model\Product;
use App\BackOffice\Products\Domain\ValueObject\Price;
use App\BackOffice\Products\Domain\ValueObject\ProductDescription;
use App\BackOffice\Products\Domain\ValueObject\ProductName;
use App\BackOffice\Products\Domain\ValueObject\Tax;
use App\BackOffice\Products\Infrastructure\ApiPlatform\Resource\ProductResource;
use App\Shared\Application\Command\CommandBusInterface;

class CreateProductProcessor implements ProcessorInterface
{
    public function __construct(private CommandBusInterface $commandBus)
    {

    }

    public function process(
        mixed $data,
        Operation $operation,
        array $uriVariables = [],
        array $context = []
    ) {
        $command = new CreateProductCommand(
            new ProductName($data->name),
            new ProductDescription($data->description),
            new Price($data->price),
            new Tax($data->tax),
        );

        /** @var Product $model */
        $model = $this->commandBus->dispatch($command);

        return ProductResource::fromModel($model);
    }
}