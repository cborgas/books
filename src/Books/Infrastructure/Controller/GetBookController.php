<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Controller;

use Books\Books\Domain\BookId;
use Books\Books\Infrastructure\Repository\BookRepository;
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
