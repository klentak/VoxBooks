<?php

declare(strict_types=1);

namespace App\Shared\CQRS\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}
