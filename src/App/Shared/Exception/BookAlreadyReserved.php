<?php

declare(strict_types=1);

namespace App\App\Shared\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class BookAlreadyReserved extends BadRequestHttpException
{
    public function __construct(int $bookId)
    {
        parent::__construct(
            message: sprintf('Book with id: %s already reserved', $bookId),
            code: Response::HTTP_BAD_REQUEST,
        );
    }
}
