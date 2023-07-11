<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller\Book;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateTest extends WebTestCase
{
    private \Symfony\Bundle\FrameworkBundle\KernelBrowser $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->client->disableReboot();
    }

    #[Test]
    public function createBookExpectsSuccessResponse(): void
    {
        $bookData = [
            'name' => 'Test Book',
        ];

        $this->client->request(Request::METHOD_POST, '/api/books', [], [], [], json_encode($bookData));

        $response = $this->client->getResponse();

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertSame('application/json', $response->headers->get('Content-Type'));

        $responseData = json_decode($response->getContent(), true);

        $this->assertSame(200, $responseData['code']);
        $this->assertSame('Book created successfully', $responseData['message']);

        $this->assertArrayHasKey('id', $responseData['data']);
        $this->assertArrayHasKey('name', $responseData['data']);

        $this->assertSame($bookData['name'], $responseData['data']['name']);
    }
}
