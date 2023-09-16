<?php

declare(strict_types=1);

namespace App\App\Book\CommandHandler;

use App\App\Book\Command\RemoveBookCommand;
use App\App\Shared\CQRS\Command\CommandHandler;
use App\App\Shared\Infrastructure\Repository\Book\BookCommandRepository;

class RemoveBookHandler implements CommandHandler
{
    public function __construct(
        private readonly BookCommandRepository $commandRepository,
    ) {
    }

    public function __invoke(RemoveBookCommand $removeBookCommand): void
    {
        $this->commandRepository->remove($removeBookCommand->getId());
    }
}
