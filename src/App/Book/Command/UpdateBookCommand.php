<?php

declare(strict_types=1);

namespace App\App\Book\Command;

class UpdateBookCommand
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $author,
        private readonly int $isbn,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
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
