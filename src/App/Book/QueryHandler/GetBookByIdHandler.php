<?php

declare(strict_types=1);

namespace App\App\Book\QueryHandler;

use App\App\Book\Query\GetBookByIdQuery;
use App\App\Book\View\BookView;
use App\App\Shared\CQRS\Query\QueryHandler;
use App\App\Shared\Exception\NotFoundException;
use App\App\Shared\Infrastructure\Repository\BookQueryRepository;

class GetBookByIdHandler implements QueryHandler
{
    public function __construct(
        private readonly BookQueryRepository $bookQueryRepository
    ) {
    }

    public function __invoke(GetBookByIdQuery $query): BookView
    {
        return $this->bookQueryRepository->getById($query->getId())
            ?: throw new NotFoundException('Book', $query->getId());
    }
}
