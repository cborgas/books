<?php

declare(strict_types=1);

namespace Books\Controller\Book;

use Books\Model\BookId;
use Books\Repository\AggregateRoot\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IncreaseStockController
{
    public function __construct(private BookRepository $bookRepository) {}

    #[Route('/api/books/{bookId}/increase-stock', methods: ['POST'])]
    public function increaseStock(string $bookId, Request $request): JsonResponse
    {
        $book = $this->bookRepository->retrieve(BookId::fromString($bookId));
        $payload = $request->getPayload();
        $increaseStockAmount = (int) $payload->get('amount');
        $book->increaseStock($increaseStockAmount);
        $this->bookRepository->persist($book);

        return new JsonResponse([
            'data' => [
                'id' => $book->getId()->toString(),
                'name' => $book->getName(),
                'stock' => $book->getStock()
            ],
        ]);
    }
}
