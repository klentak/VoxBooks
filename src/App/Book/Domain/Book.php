<?php

declare(strict_types=1);

namespace App\App\Book\Domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Contracts\Service\Attribute\Required;

#[Entity]
#[UniqueConstraint('isbn_unique_index', ['isbn'])]
class Book
{
    #[Required]
    #[Column(length: 255)]
    private string $name;

    #[Required]
    #[Column(length: 255)]
    private string $author;

    #[Required]
    #[Column(type: 'integer', unique: true)]
    private int $isbn;

    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private ?int $id;

    public function __construct(
        string $name,
        string $author,
        int $isbn,
        ?int $id = null,
    ) {
        $this->name = $name;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->id = $id;
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function setIsbn(int $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}
