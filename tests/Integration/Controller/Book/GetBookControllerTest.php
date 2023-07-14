<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller\Book;

use Books\Model\Book;
use Books\Repository\AggregateRoot\BookRepository;
use Books\Tests\Integration\Controller\ControllerTestCase;
use Books\Tests\Utility\UniqueBookName;
use PHPUnit\Framework\Attributes\Test;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;

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
}
