<?php

declare(strict_types=1);

namespace Books\Controller\Book;

use Books\Model\BookId;
use Books\Repository\AggregateRoot\BookRepository;
use Books\Request\Book\IncreaseStock;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class IncreaseStockController
{
    public function __construct(private BookRepository $bookRepository) {}

    #[Route('/api/books/{bookId}/increase-stock', methods: ['POST'])]
    public function increaseStock(
        string $bookId,
        #[MapRequestPayload(acceptFormat: 'json')] IncreaseStock $increaseStockRequest
    ): JsonResponse {
        $book = $this->bookRepository->retrieve(BookId::fromString($bookId));
        $book->increaseStock($increaseStockRequest->amount);
        $this->bookRepository->persist($book);

        return new JsonResponse(['data' => $book], Response::HTTP_ACCEPTED);
    }
}
