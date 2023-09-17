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

    public function save(Book $book): void
    {
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }

    public function getEntity(int $id): Book
    {
        return $this->entityManager->getRepository(Book::class)
            ->createQueryBuilder('b')
            ->where('b.id = :id')
            ->andWhere('b.deletedAt IS NULL')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
                ?: throw new NotFoundException('Book', $id);
    }
}
