<?php

declare(strict_types=1);

namespace App\App\Shared\Infrastructure\Repository;

use App\App\Book\Domain\Book;
use App\App\Shared\Exception\NotFoundException;
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

    public function delete(int $id): void
    {
        $book = $this->entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw new NotFoundException('Book', $id);
        }

        $this->entityManager->remove($book);
        $this->entityManager->flush();
    }
}
