<?php

declare(strict_types=1);

namespace App\App\Shared\Infrastructure\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Throwable;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse([
            'error' => [
                'code' => $this->getCode($exception),
                'message' => $exception->getMessage(),
            ]
        ], $this->getCode($exception));

        $event->setResponse($response);
    }

    private function getCode(Throwable $exception): int
    {
        return in_array($code = $exception->getCode(), array_keys(Response::$statusTexts))
            ? $code
            : Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
