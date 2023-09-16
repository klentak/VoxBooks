<?php

namespace App\App\Book\Command;

use App\App\Shared\CQRS\Command\Command;

class DeleteBookCommand implements Command
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
