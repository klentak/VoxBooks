<?php

declare(strict_types=1);

namespace App\App\Reservation\CommandHandler;

use App\App\Reservation\Command\ReturnCommand;
use App\App\Reservation\Repository\ReservationCommandRepository;
use App\App\Shared\CQRS\Command\CommandHandler;
use DateTime;

class ReturnHandler implements CommandHandler
{
    public function __construct(
        private readonly ReservationCommandRepository $reservationCommandRepository,
    ) {
    }

    public function __invoke(ReturnCommand $command): void
    {
        $reservation = $this->reservationCommandRepository->getLatestReservationEntityByBookId(
            $command->getBookId()
        );

        $reservation->setReturnedAt(new DateTime());

        $this->reservationCommandRepository->add($reservation);
    }
}
