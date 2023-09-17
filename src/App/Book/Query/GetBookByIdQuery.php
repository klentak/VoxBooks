<?php

declare(strict_types=1);

namespace App\App\Book\Query;

use App\App\Shared\CQRS\Query\Query;

class GetBookByIdQuery implements Query
{
    public function __construct(
        private readonly int $id
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
