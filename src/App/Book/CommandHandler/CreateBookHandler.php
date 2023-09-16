<?php

declare(strict_types=1);

namespace App\App\Book\CommandHandler;

use App\App\Book\Command\CreateBookCommand;
use App\App\Book\Domain\Book;
use App\App\Shared\CQRS\Command\CommandHandler;
use App\App\Shared\Infrastructure\Repository\Book\BookCommandRepository;

class CreateBookHandler implements CommandHandler
{
    public function __construct(
        private readonly BookCommandRepository $commandRepository
    ) {
    }

    public function __invoke(CreateBookCommand $command): void
    {
        $this->commandRepository->add(
            new Book(
                $command->getName(),
                $command->getAuthor(),
                $command->getIsbn()
            )
        );
    }
}
