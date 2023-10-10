<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Response;

use Books\Books\Domain\Book;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final  class BookCreatedSuccessResponse extends JsonResponse
{
    public function __construct(Book $book)
    {
        parent::__construct(
            ['message' => 'Book created successfully', 'data' => $book],
            Response::HTTP_CREATED
        );
    }
}
