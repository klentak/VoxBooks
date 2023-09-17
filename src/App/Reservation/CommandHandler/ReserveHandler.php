<?php

declare(strict_types=1);

namespace App\App\Reservation\CommandHandler;

use App\App\Book\Repository\BookCommandRepository;
use App\App\Reservation\Command\ReserveCommand;
use App\App\Reservation\Domain\Reservation;
use App\App\Reservation\Repository\ReservationCommandRepository;
use App\App\Reservation\Repository\ReservationQueryRepository;
use App\App\Shared\CQRS\Command\CommandHandler;
use App\App\Shared\Exception\BookAlreadyReserved;
use DateTime;

class ReserveHandler implements CommandHandler
{
    public function __construct(
        private ReservationQueryRepository $reservationQueryRepository,
        private ReservationCommandRepository $reservationCommandRepository,
        private BookCommandRepository $bookCommandRepository
    ) {
    }

    public function __invoke(ReserveCommand $command): void
    {
        if ($this->reservationQueryRepository->isBookReserved($command->getBookId())) {
            throw new BookAlreadyReserved($command->getBookId());
        }

        $this->reservationCommandRepository->add(
            new Reservation(
                $this->bookCommandRepository->getEntity($command->getBookId()),
                new DateTime(),
                $command->getReturnDate(),
            )
        );
    }
}
