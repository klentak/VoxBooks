<?php

declare(strict_types=1);

namespace App\Book\Command;


use App\Shared\CQRS\Command\Command;

class CreateBookCommand implements Command
{
    public function __construct(
        private readonly string $name,
        private readonly string $author,
        private readonly int $isbn,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getIsbn(): int
    {
        return $this->isbn;
    }
}
