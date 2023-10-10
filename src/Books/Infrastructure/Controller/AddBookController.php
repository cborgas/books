<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Controller;

use Books\Books\Application\Command\AddBookCommand;
use Books\Books\Infrastructure\Request\AddBook;
use Books\Books\Infrastructure\Response\BookAddedSuccessResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

final readonly class AddBookController
{
    public function __construct(private AddBookCommand $command) {}

    #[Route('/api/books', methods: ['POST'])]
    public function add(#[MapRequestPayload(acceptFormat: 'json')] AddBook $createBookRequest): JsonResponse
    {
        $book = $this->command->add($createBookRequest);

        return new BookAddedSuccessResponse($book);
    }
}
