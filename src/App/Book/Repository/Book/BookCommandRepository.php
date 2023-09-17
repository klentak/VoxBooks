<?php

declare(strict_types=1);

namespace App\App\Book\Repository\Book;

use App\App\Book\Domain\Book;
use App\App\Shared\Infrastructure\Exception\NotFoundException;
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

    public function update(
        int $id,
        string $name,
        string $author,
        string $isbn
    ): void {
        $book = $this->getEntity($id);

        $book->setTitle($name);
        $book->setAuthor($author);
        $book->setIsbn($isbn);

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

    private function getEntity($id): Book
    {
        return $this->entityManager->find(Book::class, $id)
            ?: throw new NotFoundException('Book', $id);
    }
}
