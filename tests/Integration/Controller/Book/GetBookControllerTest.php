<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller\Book;

use Books\Model\Book;
use Books\Repository\AggregateRoot\BookRepository;
use Books\Tests\Integration\Controller\ControllerTestCase;
use PHPUnit\Framework\Attributes\Test;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;

class GetBookControllerTest extends ControllerTestCase
{
    private readonly BookRepository $bookRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->bookRepository = self::getContainer()->get(BookRepository::class);
    }

    #[Test]
    public function get_book_by_id_expects_book_name_in_response(): void
    {
        $uniqueBookName = 'Book for Reading ' . Uuid::uuid4()->toString();
        $book = Book::create($uniqueBookName);
        $this->bookRepository->persist($book);

        $this->client->request(Request::METHOD_GET, '/api/books/' . $book->getId()->toString());
        $response = $this->client->getResponse();

        $this->assertStringContainsString($uniqueBookName, $response->getContent());
    }
}
