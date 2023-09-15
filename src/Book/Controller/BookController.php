<?php

declare(strict_types=1);

namespace App\Book\Controller;

use App\Book\Command\CreateBookCommand;
use App\Book\Enum\BookResponseMessageEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/books', name: 'books.')]
class BookController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
    ) {
    }

    #[Route('', name: 'create', methods: [Request::METHOD_POST])]
    public function create(Request $request): JsonResponse
    {
        $this->commandBus->dispatch(
            new CreateBookCommand(
                $request->get('name'),
                $request->get('author'),
                (int) $request->get('isbn'),
            )
        );

        return new JsonResponse(
            data: ['message' => BookResponseMessageEnum::CREATED_MESSAGE],
            status: Response::HTTP_CREATED
        );
    }
}
