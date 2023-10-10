<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Response;

use Books\Books\Domain\Model\Book;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final  class BookAddedSuccessResponse extends JsonResponse
{
    public function __construct(Book $book)
    {
        parent::__construct(
            ['message' => 'Book successfully added to your collection', 'data' => $book],
            Response::HTTP_CREATED
        );
    }
}
