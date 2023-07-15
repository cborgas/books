<?php

declare(strict_types=1);

namespace Books\Controller\Book;

use Books\Model\BookId;
use Books\Repository\AggregateRoot\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IncreaseStockController
{
    public function __construct(private BookRepository $bookRepository) {}

    #[Route('/api/books/{bookId}/increase-stock', methods: ['POST'])]
    public function increaseStock(string $bookId, Request $request): JsonResponse
    {
        $book = $this->bookRepository->retrieve(BookId::fromString($bookId));
        $payload = $request->getPayload();

        $book->increaseStock((int) $payload->get('amount'));
        $this->bookRepository->persist($book);

        return new JsonResponse(['data' => $book], Response::HTTP_ACCEPTED);
    }
}
