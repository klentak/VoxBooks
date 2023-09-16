<?php

declare(strict_types=1);

namespace App\App\Shared\Infrastructure\Repository;

use App\App\Book\Domain\Book;
use Doctrine\ORM\EntityManagerInterface;

class BookCommandRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function add(Book $book): void
    {
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }
}
