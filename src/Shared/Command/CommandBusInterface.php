<?php

namespace App\Shared\Command;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): mixed;
}