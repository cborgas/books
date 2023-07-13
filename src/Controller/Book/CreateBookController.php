<?php

declare(strict_types=1);

namespace Books\Controller\Book;

use Books\Model\Book;
use Books\Model\BookId;
use Books\Repository\AggregateRoot\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final readonly class CreateBookController
{
    public function __construct(private BookRepository $bookRepository) {}

    #[Route('/api/books', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $bookId = BookId::create();
        $book = Book::create($bookId, $data['name'] ?? null);

        $this->bookRepository->persist($book);

        return new JsonResponse([
            'code' => 200,
            'message' => 'Book created successfully',
            'data' => [
                'id' => $bookId->toString(),
                'name' => $book->getName(),
            ],
        ]);
    }
}
