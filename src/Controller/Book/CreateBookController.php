<?php

declare(strict_types=1);

namespace Books\Controller\Book;

use Books\Model\Book;
use Books\Model\BookId;
use Books\Repository\AggregateRoot\BookRepository;
use Books\Response\Book\BookCreatedSuccessResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final readonly class CreateBookController
{
    public function __construct(private BookRepository $bookRepository) {}

    #[Route('/api/books', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $payload = $request->getPayload();

        $book = Book::create($payload->get('name'));
        $this->bookRepository->persist($book);

        return new BookCreatedSuccessResponse($book);
    }
}
