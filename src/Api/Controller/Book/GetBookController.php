<?php

declare(strict_types=1);

namespace Books\Api\Controller\Book;

use Books\Model\BookId;
use Books\Repository\AggregateRoot\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetBookController
{
    public function __construct(private BookRepository $bookRepository) {}

    #[Route('/api/books/{bookId}', methods: ['GET'])]
    public function get(BookId $bookId): JsonResponse
    {
        $book = $this->bookRepository->retrieve($bookId);

        if (!$book->isCreated()) {
            return new JsonResponse(['error' => ['message' => 'Book not found']], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse(['data' => $book]);
    }
}
