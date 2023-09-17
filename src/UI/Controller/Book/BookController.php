<?php

declare(strict_types=1);

namespace App\UI\Controller\Book;

use App\App\Book\Command\CreateBookCommand;
use App\App\Book\Command\RemoveBookCommand;
use App\App\Book\Command\UpdateBookCommand;
use App\App\Book\Enum\BookResponseMessageEnum;
use App\App\Book\Query\GetAllBooksQuery;
use App\App\Book\Query\GetBookByIdQuery;
use App\App\Book\View\BookView;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

#[Route('/books', name: 'books.')]
class BookController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
        private readonly MessageBusInterface $queryBus
    ) {
    }

    #[
        Route('', name: 'create', methods: [Request::METHOD_POST]),
        OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'title', type: 'string'),
                    new OA\Property(property: 'author', type: 'string'),
                    new OA\Property(property: 'isbn', type: 'string'),
                ]
            )
        )
    ]
    public function create(Request $request): JsonResponse
    {
        $data = $request->toArray();

        $this->commandBus->dispatch(
            new CreateBookCommand(
                $data['title'],
                $data['author'],
                $data['isbn'],
            )
        );

        return new JsonResponse([
            'message' => BookResponseMessageEnum::CREATED_MESSAGE
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: [Request::METHOD_DELETE])]
    public function remove(int $id): JsonResponse
    {
        $this->commandBus->dispatch(
            new RemoveBookCommand($id)
        )->last(HandledStamp::class);

        return new JsonResponse(
            data: ['message' => BookResponseMessageEnum::REMOVED_MESSAGE],
            status: Response::HTTP_CREATED
        );
    }

    #[
        Route('/{id}', name: 'update', methods: [Request::METHOD_PUT]),
        OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'title', type: 'string'),
                    new OA\Property(property: 'author', type: 'string'),
                    new OA\Property(property: 'isbn', type: 'string'),
                ]
            )
        )
    ]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = $request->toArray();

        $this->commandBus->dispatch(
            new UpdateBookCommand(
                $id,
                $data['title'],
                $data['author'],
                $data['isbn'],
            )
        )->last(HandledStamp::class);

        return new JsonResponse([
            'message' => BookResponseMessageEnum::UPDATED_MESSAGE
        ]);
    }

    #[
        Route('/{id}', name: 'getById', methods: [Request::METHOD_GET]),
        OA\Response(
            response: 200,
            description: 'Successful response',
            content: new Model(type: BookView::class)
        )
    ]
    public function getById(int $id): JsonResponse
    {
        return new JsonResponse(
            $this->queryBus->dispatch(
                new GetBookByIdQuery($id)
            )->last(HandledStamp::class)
            ->getResult()
        );
    }

    #[
        Route('', name: 'getAll', methods: [Request::METHOD_GET]),
        OA\Response(
            response: 200,
            description: 'Returns all books',
            content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(ref: new Model(type: BookView::class, groups: ['full']))
            )
        )
    ]
    public function getAll(): JsonResponse
    {
        $result = $this->queryBus->dispatch(
            new GetAllBooksQuery()
        )->last(HandledStamp::class);

        return new JsonResponse(
            array_map(function(BookView $result): array {
                return $result->jsonSerialize();
            }, $result->getResult())
        );
    }
}
