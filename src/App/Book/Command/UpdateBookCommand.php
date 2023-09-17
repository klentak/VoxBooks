<?php

declare(strict_types=1);

namespace App\App\Book\Command;

class UpdateBookCommand
{
    public function __construct(
        private readonly int $id,
        private readonly string $title,
        private readonly string $author,
        private readonly string $isbn,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }
}
