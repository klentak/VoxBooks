<?php

declare(strict_types=1);

namespace App\App\Shared\Infrastructure\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class BookReserved extends BadRequestHttpException
{
    public function __construct()
    {
        parent::__construct(
            message: 'Can not remove reserved book',
            code: Response::HTTP_BAD_REQUEST
        );
    }
}
