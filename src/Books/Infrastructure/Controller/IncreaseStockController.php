<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Controller;

use Books\Books\Domain\BookId;
use Books\Books\Infrastructure\Request\IncreaseStock;
use Books\Repository\AggregateRoot\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class IncreaseStockController
{
    public function __construct(private BookRepository $bookRepository) {}

    #[Route('/api/books/{bookId}/increase-stock', methods: ['POST'])]
    public function increaseStock(
        BookId $bookId,
        #[MapRequestPayload(acceptFormat: 'json')] IncreaseStock $increaseStockRequest
    ): JsonResponse {
        $book = $this->bookRepository->retrieve($bookId);
        $book->increaseStock($increaseStockRequest->amount);
        $this->bookRepository->persist($book);

        return new JsonResponse(['data' => $book], Response::HTTP_ACCEPTED);
    }
}
