<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller\Book;

use Books\Model\Book;
use Books\Repository\AggregateRoot\BookRepository;
use Books\Tests\Integration\Controller\ControllerTestCase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Request;

class IncreaseSockControllerTest extends ControllerTestCase
{
    private readonly BookRepository $bookRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->bookRepository = self::getContainer()->get(BookRepository::class);
    }

    #[Test]
    public function increase_stock_expects_book_stock_count_to_increase(): void
    {
        $book = Book::create('A Book to Stock');
        $this->bookRepository->persist($book);

        $this->increaseStock($book, 10);
        $responseData = $this->getJsonResponse();

        $this->assertSame(10, $responseData['data']['stock']);
    }

    protected function increaseStock(Book $book, int $amount): void
    {
        $this->client->request(
            Request::METHOD_POST,
            sprintf('/api/books/%s/increase-stock', $book->getId()->toString()),
            content: json_encode(['amount' => $amount])
        );
    }
}
