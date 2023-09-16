<?php

declare(strict_types=1);

namespace App\App\Book\CommandHandler;

use App\App\Book\Command\UpdateBookCommand;
use App\App\Shared\CQRS\Command\CommandHandler;
use App\App\Shared\Infrastructure\Repository\Book\BookCommandRepository;

class UpdateBookHandler implements CommandHandler
{
    public function __construct(
        private readonly BookCommandRepository $commandRepository
    ) {
    }

    public function __invoke(UpdateBookCommand $command): void
    {
        $this->commandRepository->update(
                $command->getId(),
                $command->getName(),
                $command->getAuthor(),
                $command->getIsbn(),
        );
    }
}
