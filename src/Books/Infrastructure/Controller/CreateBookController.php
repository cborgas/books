<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Controller;

use Books\Books\Domain\Book;
use Books\Books\Infrastructure\Request\CreateBook;
use Books\Books\Infrastructure\Response\BookCreatedSuccessResponse;
use Books\Repository\AggregateRoot\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

final readonly class CreateBookController
{
    public function __construct(private BookRepository $bookRepository) {}

    #[Route('/api/books', methods: ['POST'])]
    public function create(#[MapRequestPayload(acceptFormat: 'json')] CreateBook $createBookRequest): JsonResponse
    {
        $book = Book::create($createBookRequest->name);
        $this->bookRepository->persist($book);

        return new BookCreatedSuccessResponse($book);
    }
}
