<?php

declare(strict_types=1);

namespace App\App\Book\Command;

use App\App\Shared\CQRS\Command\Command;

class RemoveBookCommand implements Command
{
    public function __construct(
        private readonly int $id
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
