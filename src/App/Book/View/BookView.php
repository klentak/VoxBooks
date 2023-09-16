<?php

declare(strict_types=1);

namespace App\App\Book\View;

use JsonSerializable;

class BookView implements JsonSerializable
{
    public function __construct(
        private readonly int $id,
        private readonly string $title,
        private readonly string $author,
        private readonly string $isbn
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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
        ];
    }
}
