<?php

declare(strict_types=1);

namespace App\App\Book\CommandHandler;

use App\App\Book\Command\DeleteBookCommand;
use App\App\Shared\CQRS\Command\CommandHandler;
use App\App\Shared\Infrastructure\Repository\BookCommandRepository;

class DeleteBookHandler implements CommandHandler
{
    public function __construct(
        private readonly BookCommandRepository $commandRepository,
    ) {
    }

    public function __invoke(DeleteBookCommand $deleteBookCommand): void
    {
        $this->commandRepository->delete($deleteBookCommand->getId());
    }
}
