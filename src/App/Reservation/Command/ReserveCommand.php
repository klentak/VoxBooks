<?php

declare(strict_types=1);

namespace App\App\Reservation\Command;

use App\App\Shared\CQRS\Command\Command;
use DateTime;

class ReserveCommand implements Command
{
    public function __construct(
        readonly private int $bookId,
        readonly private DateTime $returnDate,
    ) {
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }

    public function getReturnDate(): DateTime
    {
        return $this->returnDate;
    }
}
