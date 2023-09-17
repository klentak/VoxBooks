<?php

declare(strict_types=1);

namespace App\App\Book\Domain;

use DateTime;
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
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue(strategy: 'SEQUENCE')]
    private ?int $id;

    #[Required]
    #[Column(length: 255)]
    private string $title;

    #[Required]
    #[Column(length: 255)]
    private string $author;

    #[Required]
    #[Column(type: 'string', length: 13, unique: true)]
    private string $isbn;

    #[Column(type: 'datetime', nullable: true)]
    private ?DateTime $deletedAt;

    public function __construct(
        string $name,
        string $author,
        string $isbn,
        ?int $id = null,
        ?DateTime $deletedAt = null,
    ) {
        $this->title = $name;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->id = $id;
        $this->deletedAt = $deletedAt;
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

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setDeletedAt(?DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
