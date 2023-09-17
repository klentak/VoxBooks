<?php

declare(strict_types=1);

namespace App\App\Book\Repository;

use App\App\Book\Domain\Book;
use App\App\Book\View\BookView;
use App\App\Shared\Exception\NotFoundException;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class BookQueryRepository
{
    public function __construct(
        private readonly Connection $connection
    ) {
    }

    /**
     * @throws Exception
     */
    public function getById(int $bookId): ?BookView
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->select(['b.id', 'b.title', 'b.author', 'b.isbn'])
            ->from('book', 'b')
            ->where('b.id = :bookId')
            ->setParameter('bookId', $bookId);

        $bookData = $this->connection->fetchAssociative(
            $queryBuilder->getSQL(),
            $queryBuilder->getParameters()
        );


        return $bookData
            ? new BookView(
                $bookData['id'],
                $bookData['title'],
                $bookData['author'],
                $bookData['isbn']
            ) : null;
    }

    public function getAll(): array
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->select(['b.id', 'b.title', 'b.author', 'b.isbn'])
            ->from('book', 'b');

        $bookData = $this->connection->fetchAllAssociative(
            $queryBuilder->getSQL(),
            $queryBuilder->getParameters()
        );

        return array_map(function(array $bookData) {
            return new BookView(
                $bookData['id'],
                $bookData['title'],
                $bookData['author'],
                $bookData['isbn']
            );
        }, $bookData);
    }
}
