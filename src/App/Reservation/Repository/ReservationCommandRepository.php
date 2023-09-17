<?php

declare(strict_types=1);

namespace App\App\Reservation\Repository;

use App\App\Reservation\Domain\Reservation;
use App\App\Shared\Infrastructure\Exception\ReservationNotFound;
use Doctrine\ORM\EntityManagerInterface;

class ReservationCommandRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function add(Reservation $reservation): void
    {
        $this->entityManager->persist($reservation);
        $this->entityManager->flush();
    }

    public function getLatestReservationEntityByBookId(int $bookId): Reservation
    {
        return $this->entityManager->getRepository(Reservation::class)
            ->createQueryBuilder('r')
            ->where('r.book = :bookId')
            ->andWhere('r.returnedAt IS NULL')
            ->setParameter('bookId', $bookId)
            ->getQuery()
            ->getOneOrNullResult()
                ?: throw new ReservationNotFound();
    }
}
