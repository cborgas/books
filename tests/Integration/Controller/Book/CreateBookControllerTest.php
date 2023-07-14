<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller\Book;

use Books\Tests\Integration\Controller\ControllerTestCase;
use PHPUnit\Framework\Attributes\Test;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
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
        $this->assertSame('Book created successfully', $responseData['message']);
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
}
