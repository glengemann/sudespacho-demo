<?php

namespace App\Shared\Infrastructure\Symfony\Messenger;

use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Application\Query\QueryInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerQueryBus implements QueryBusInterface
{
    use HandleTrait;

    public function __construct(private MessageBusInterface $queryBus)
    {
        $this->messageBus = $this->queryBus;
    }

    public function ask(QueryInterface $query): mixed
    {
        try {
            return $this->handle($query);
        } catch (HandlerFailedException $e) {
            if ($exception = current($e->getWrappedExceptions())) {
                throw $exception;
            }

            throw $e;
        }
    }
}