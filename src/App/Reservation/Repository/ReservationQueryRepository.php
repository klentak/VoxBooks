<?php

declare(strict_types=1);

namespace App\App\Reservation\Repository;

use Doctrine\DBAL\Connection;

class ReservationQueryRepository
{
    public function __construct(
        private readonly Connection $connection
    ) {
    }

    public function isBookReserved(int $bookId): bool
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->select(['1'])
            ->from('reservation', 'r')
            ->where('r.book_id = :bookId')
            ->where('r.returned_at IS NULL')
            ->setParameter('bookId', $bookId);

        return !!$this->connection->fetchAssociative(
            $queryBuilder->getSQL(),
            $queryBuilder->getParameters()
        );
    }
}
