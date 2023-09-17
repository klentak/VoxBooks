<?php

declare(strict_types=1);

namespace App\App\Book\Repository;

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

    public function remove(int $id): void
    {
        $this->entityManager->remove(
            $this->getEntity($id)
        );
        $this->entityManager->flush();
    }

    public function getEntity($id): Book
    {
        return $this->entityManager->find(Book::class, $id)
            ?: throw new NotFoundException('Book', $id);
    }
}
