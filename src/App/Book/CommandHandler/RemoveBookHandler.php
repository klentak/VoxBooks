<?php

declare(strict_types=1);

namespace App\App\Book\CommandHandler;

use App\App\Book\Command\RemoveBookCommand;
use App\App\Book\Repository\BookCommandRepository;
use App\App\Reservation\Repository\ReservationQueryRepository;
use App\App\Shared\CQRS\Command\CommandHandler;
use App\App\Shared\Infrastructure\Exception\BookReserved;
use DateTime;

class RemoveBookHandler implements CommandHandler
{
    public function __construct(
        private readonly BookCommandRepository $bookCommandRepository,
        private readonly ReservationQueryRepository $reservationQueryRepository,
    ) {
    }

    public function __invoke(RemoveBookCommand $removeBookCommand): void
    {
        if ($this->reservationQueryRepository->isBookReserved($removeBookCommand->getId()))
        {
            throw new BookReserved();
        }

        $book = $this->bookCommandRepository->getEntity($removeBookCommand->getId());

        $book->setDeletedAt(new DateTime());

        $this->bookCommandRepository->save($book);
    }
}
