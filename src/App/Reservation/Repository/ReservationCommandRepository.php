<?php

namespace App\App\Reservation\Repository;

use App\App\Book\Domain\Book;
use App\App\Reservation\Domain\Reservation;
use App\App\Shared\Exception\NotFoundException;
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

    public function getBookEntity(int $id)
    {
        return $this->entityManager->find(Book::class, $id)
            ?: throw new NotFoundException('Book', $id);
    }
}
