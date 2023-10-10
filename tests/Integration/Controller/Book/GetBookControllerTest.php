<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller\Book;

use Books\Books\Domain\BookId;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetBookControllerTest extends BookControllerTestCase
{
    #[Test]
    public function get_book_by_id_expects_book_name_in_response(): void
    {
        $name = 'Book for Reading';
        $this->createBook($name);

        $this->client->request(Request::METHOD_GET, '/api/books/' . $this->getBookId());
        $responseData = $this->getJsonResponse();

        $this->assertSame($name, $responseData['data']['name']);
    }

    #[Test]
    public function get_book_by_id_expects_error_response_when_book_not_found(): void
    {
        $this->client->request(Request::METHOD_GET, '/api/books/' . BookId::create()->toString());
        $responseData = $this->getJsonResponse();

        $this->assertSame('Book not found', $responseData['error']['message']);
        $this->assertSame(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
    }
}
