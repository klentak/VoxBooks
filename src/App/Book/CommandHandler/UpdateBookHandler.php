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
        $book = $this->commandRepository->getEntity($command->getId());

        $book->setTitle($command->getTitle());
        $book->setAuthor($command->getAuthor());
        $book->setIsbn($command->getIsbn());

        $this->commandRepository->save(
            $book
        );
    }
}
