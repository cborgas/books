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
    public function get(BookId $bookId): JsonResponse
    {
        $book = $this->bookRepository->retrieve($bookId);

        return new JsonResponse(['data' => $book]);
    }
}
