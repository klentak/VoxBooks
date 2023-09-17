<?php

declare(strict_types=1);

namespace App\App\Book\CommandHandler;

use App\App\Book\Command\UpdateBookCommand;
use App\App\Book\Repository\BookCommandRepository;
use App\App\Shared\CQRS\Command\CommandHandler;

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
            $command->getTitle(),
            $command->getAuthor(),
            $command->getIsbn(),
        );
    }
}
