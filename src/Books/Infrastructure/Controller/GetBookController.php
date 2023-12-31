<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Controller;

use Books\Books\Domain\Model\BookId;
use Books\Books\Domain\Repository\BookRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

readonly class GetBookController
{
    public function __construct(private BookRepositoryInterface $bookRepository) {}

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
