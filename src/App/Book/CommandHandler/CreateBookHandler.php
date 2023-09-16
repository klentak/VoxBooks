<?php

declare(strict_types=1);

namespace App\App\Book\CommandHandler;

use App\App\Book\Command\CreateBookCommand;
use App\App\Book\Domain\Book;
use App\App\Shared\CQRS\Command\CommandHandler;
use App\App\Shared\Infrastructure\Repository\BookCommandRepository;

class CreateBookHandler implements CommandHandler
{
    public function __construct(
        private readonly BookCommandRepository $books
    ) {
    }

    public function __invoke(CreateBookCommand $command): void
    {
        $this->books->add(
            new Book(
                $command->getName(),
                $command->getAuthor(),
                $command->getIsbn()
            )
        );
    }
}
