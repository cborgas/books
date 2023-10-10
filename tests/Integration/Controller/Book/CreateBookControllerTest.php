<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller\Book;

use PHPUnit\Framework\Attributes\Test;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateBookControllerTest extends BookControllerTestCase
{
    #[Test]
    public function create_book_expects_success_response(): void
    {
        $response = $this->createBook();
        $responseData = $this->getJsonResponse();

        $this->assertSame(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertSame('application/json', $response->headers->get('Content-Type'));
        $this->assertSame('Book successfully added to your collection', $responseData['message']);
        $this->assertArrayHasKey('id', $responseData['data']);
        $this->assertArrayHasKey('name', $responseData['data']);
    }

    #[Test]
    public function create_book_expects_book_in_response_payload(): void
    {
        $name = 'Test Book';
        $this->createBook($name);
        $responseData = $this->getJsonResponse();

        $this->assertTrue(Uuid::isValid($responseData['data']['id']));
        $this->assertSame($name, $responseData['data']['name']);
    }

    #[Test]
    public function  create_book_with_empty_payload_expects_error_response(): void
    {
        $this->client->request(
            Request::METHOD_POST,
            '/api/books',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([])
        );

        $this->assertSame(Response::HTTP_UNPROCESSABLE_ENTITY, $this->client->getResponse()->getStatusCode());
    }
}
