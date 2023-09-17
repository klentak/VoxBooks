<?php

declare(strict_types=1);

namespace App\App\Book\CommandHandler;

use App\App\Book\Command\CreateBookCommand;
use App\App\Book\Domain\Book;
use App\App\Book\Repository\BookCommandRepository;
use App\App\Shared\CQRS\Command\CommandHandler;

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
                $command->getTitle(),
                $command->getAuthor(),
                $command->getIsbn()
            )
        );
    }
}
