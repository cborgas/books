<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Repository\AggregateRoot;

use Books\Books\Domain\Book;
use Books\Books\Infrastructure\Repository\BookRepository;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BookRepositoryTest extends KernelTestCase
{
    private readonly BookRepository $bookRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->bookRepository = self::getContainer()->get(BookRepository::class);
    }

    #[Test]
    public function retrieve_expects_book_when_book_exists(): void
    {
        $book = Book::create('Test Book for Reading');
        $bookId = $book->getId();
        $this->bookRepository->persist($book);

        $book = $this->bookRepository->retrieve($bookId);

        $this->assertEquals($bookId->toString(), $book->getId()->toString());
    }
}
