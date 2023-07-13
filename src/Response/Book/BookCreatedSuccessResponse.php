<?php

declare(strict_types=1);

namespace Books\Response\Book;

use Books\Model\Book;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final  class BookCreatedSuccessResponse extends JsonResponse
{
    public function __construct(Book $book)
    {
        parent::__construct(
            [
                'message' => 'Book created successfully',
                'data' => [
                    'id' => $book->getId()->toString(),
                    'name' => $book->getName(),
                ],
        ], Response::HTTP_OK);
    }
}
