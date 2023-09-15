<?php

declare(strict_types=1);

namespace App\Book\CommandHandler;

use App\Book\Command\CreateBookCommand;
use App\Book\Domain\Book;
use App\Infrastructure\DoctrineBooks;
use App\Shared\CQRS\Command\CommandHandler;

class CreateBookCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly DoctrineBooks $books
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
