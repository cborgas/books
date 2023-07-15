<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller\Book;

use Books\Tests\Integration\Controller\ControllerTestCase;
use Books\Tests\Utility\UniqueBookName;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookControllerTestCase extends ControllerTestCase
{
    protected function createBook(string &$name = 'Test Book'): Response
    {
        $name = UniqueBookName::generate($name);

        $this->client->request(
            Request::METHOD_POST,
            '/api/books',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode(['name' => $name])
        );

        return $this->client->getResponse();
    }

    protected function getBookId(): string
    {
        $responseData = $this->getJsonResponse();
        return $responseData['data']['id'];
    }

    protected function increaseStock(string $bookId, int $amount): void
    {
        $this->client->request(
            Request::METHOD_POST,
            sprintf('/api/books/%s/increase-stock', $bookId),
            content: json_encode(['amount' => $amount])
        );
    }
}
