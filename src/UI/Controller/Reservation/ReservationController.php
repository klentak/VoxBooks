<?php

declare(strict_types=1);

namespace App\UI\Controller\Reservation;

use App\App\Book\View\BookView;
use App\App\Reservation\Command\ReserveCommand;
use App\App\Reservation\Command\ReturnCommand;
use App\App\Reservation\Enum\ReservationResponseMessageEnum;
use DateTime;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

#[Route('/books/{bookId}', name: 'books.reservation')]
class ReservationController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
    ) {
    }

    #[
        Route('/reserve', name: 'reserve', methods: [Request::METHOD_POST]),
        OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'returnDate', type: 'string', format: 'date-time'),
                ]
            )
        )
    ]
    public function reserve(int $bookId, Request $request): JsonResponse
    {
        $this->commandBus->dispatch(
            new ReserveCommand(
                $bookId,
                new DateTime($request->toArray()['returnDate'])
            )
        );

        return new JsonResponse([
            'message' => ReservationResponseMessageEnum::CREATED_MESSAGE
        ]);
    }

    #[Route('/return', name: 'return', methods: [Request::METHOD_POST])]
    public function return(int $bookId): JsonResponse
    {
        $this->commandBus->dispatch(
            new ReturnCommand($bookId)
        );

        return new JsonResponse([
            'message' => ReservationResponseMessageEnum::RETURNED_MESSAGE
        ]);
    }
}
