<?php

declare(strict_types=1);

namespace App\App\Book\Command;


use App\App\Shared\CQRS\Command\Command;

class CreateBookCommand implements Command
{
    public function __construct(
        private readonly string $title,
        private readonly string $author,
        private readonly string $isbn,
    ) {
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
