<?php

declare(strict_types=1);

namespace App\App\Shared\Infrastructure\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReservationNotFound extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct(
            message: 'Reservation not found',
            code: Response::HTTP_NOT_FOUND
        );
    }
}
