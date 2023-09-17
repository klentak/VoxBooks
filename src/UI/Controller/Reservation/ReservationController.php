<?php

namespace App\UI\Controller\Reservation;

use App\App\Reservation\Command\ReserveCommand;
use App\App\Reservation\Enum\ReservationResponseMessageEnum;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/books/{id}', name: 'books.reservation')]
class ReservationController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
    ) {
    }

    #[Route('/reserve', name: 'reserve', methods: [Request::METHOD_POST])]
    public function reserve(int $id, Request $request): JsonResponse
    {
        $this->commandBus->dispatch(
            new ReserveCommand(
                $id,
                new DateTime($request->get('returnDate'))
            )
        );

        return new JsonResponse([
            'message' => ReservationResponseMessageEnum::CREATED_MESSAGE
        ]);
    }
}
