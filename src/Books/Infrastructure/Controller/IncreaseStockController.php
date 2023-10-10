<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Controller;

use Books\Books\Application\Command\IncreaseStockCommand;
use Books\Books\Domain\Model\BookId;
use Books\Books\Domain\Repository\BookRepositoryInterface;
use Books\Books\Infrastructure\Request\IncreaseStock;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

readonly class IncreaseStockController
{
    public function __construct(
        private BookRepositoryInterface $bookRepository,
        private IncreaseStockCommand $command
    ) {
    }

    #[Route('/api/books/{bookId}/increase-stock', methods: ['POST'])]
    public function increaseStock(
        BookId $bookId,
        #[MapRequestPayload(acceptFormat: 'json')] IncreaseStock $increaseStockRequest
    ): JsonResponse {
        $book = $this->bookRepository->retrieve($bookId);
        $this->command->increaseStock($book, $increaseStockRequest);

        return new JsonResponse(['data' => $book], Response::HTTP_ACCEPTED);
    }
}
