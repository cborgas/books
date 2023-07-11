<?php

declare(strict_types=1);

namespace Books\Controller\Book;

use Books\Model\Book;
use Books\Model\BookId;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class Create
{
    #[Route('/api/books', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $name = $data['name'] ?? null;

        $bookId = BookId::create();
        $book = Book::create($bookId, $name);

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
