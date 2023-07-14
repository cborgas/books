<?php

declare(strict_types=1);

namespace Books\Controller\Book;

use Books\Model\BookId;
use Books\Repository\AggregateRoot\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetBookController
{
    public function __construct(private BookRepository $bookRepository) {}

    #[Route('/api/books/{bookId}', methods: ['GET'])]
    public function get(string $bookId): JsonResponse
    {
        $book = $this->bookRepository->retrieve(BookId::fromString($bookId));

        return new JsonResponse([
            'data' => [
                'id' => $book->getId()->toString(),
                'name' => $book->getName(),
            ],
        ]);
    }
}