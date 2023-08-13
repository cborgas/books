<?php

declare(strict_types=1);

namespace Books\Api\Controller\Book;

use Books\Model\Book;
use Books\Repository\AggregateRoot\BookRepository;
use Books\Request\Book\CreateBook;
use Books\Response\Book\BookCreatedSuccessResponse;
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
