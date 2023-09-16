<?php

declare(strict_types=1);

namespace App\UI\Controller\Book;

use App\App\Book\Command\CreateBookCommand;
use App\App\Book\Command\DeleteBookCommand;
use App\App\Book\Enum\BookResponseMessageEnum;
use App\App\Book\Query\GetAllBooksQuery;
use App\App\Book\Query\GetBookByIdQuery;
use App\App\Book\View\BookView;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/books', name: 'books.')]
class BookController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
        private readonly MessageBusInterface $queryBus
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

        return new JsonResponse([
            'message' => BookResponseMessageEnum::CREATED_MESSAGE
        ]);
    }


    #[Route('/{id}', name: 'delete', methods: [Request::METHOD_DELETE])]
    public function delete(int $id): JsonResponse
    {
        $this->commandBus->dispatch(
            new DeleteBookCommand($id)
        )->last(HandledStamp::class);

        return new JsonResponse(
            data: ['message' => BookResponseMessageEnum::DELETED_MESSAGE],
            status: Response::HTTP_CREATED
        );
    }

    #[Route('/{id}', name: 'getById', methods: [Request::METHOD_GET])]
    public function getById(int $id): JsonResponse
    {
        return new JsonResponse(
            $this->queryBus->dispatch(
                new GetBookByIdQuery($id)
            )->last(HandledStamp::class)
            ->getResult()
        );
    }

    #[Route('', name: 'getAll', methods: [Request::METHOD_GET])]
    public function getAll(): JsonResponse
    {
        $result = $this->queryBus->dispatch(
            new GetAllBooksQuery()
        )->last(HandledStamp::class);

        return new JsonResponse(
            array_map(function(BookView $result) {
                return $result->jsonSerialize();
            }, $result->getResult())
        );
    }
}
