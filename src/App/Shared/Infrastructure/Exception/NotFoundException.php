<?php

namespace App\App\Shared\Infrastructure\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundException extends NotFoundHttpException
{
    public function __construct(string $name, int $id)
    {
        parent::__construct(
            message: sprintf(
                '%s with id: %s does not exist',
                $name,
                $id
            ),
            code: Response::HTTP_NOT_FOUND
        );
    }
}
