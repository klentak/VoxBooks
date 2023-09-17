<?php

declare(strict_types=1);

namespace App\App\Reservation\Command;

use App\App\Shared\CQRS\Command\Command;
use DateTime;

class ReturnCommand implements Command
{
    public function __construct(
        readonly private int $bookId,
    ) {
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }
}
