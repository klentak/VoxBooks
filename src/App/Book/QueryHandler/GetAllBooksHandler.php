<?php

declare(strict_types=1);

namespace App\App\Book\QueryHandler;

use App\App\Book\Query\GetAllBooksQuery;
use App\App\Book\Repository\BookQueryRepository;
use App\App\Shared\CQRS\Query\QueryHandler;

class GetAllBooksHandler implements QueryHandler
{
    public function __construct(
        private readonly BookQueryRepository $bookQueryRepository
    ) {
    }

    public function __invoke(GetAllBooksQuery $query): array
    {
        return $this->bookQueryRepository->getAll();
    }
}
