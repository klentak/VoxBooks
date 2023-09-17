<?php

declare(strict_types=1);

namespace App\App\Reservation\Repository;

use App\App\Reservation\Domain\Reservation;
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
}
