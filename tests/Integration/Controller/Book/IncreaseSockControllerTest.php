<?php

declare(strict_types=1);

namespace Books\Tests\Integration\Controller\Book;

use Books\Model\Book;
use Books\Repository\AggregateRoot\BookRepository;
use Books\Tests\Integration\Controller\ControllerTestCase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Request;

class IncreaseSockControllerTest extends BookControllerTestCase
{
    #[Test]
    public function increase_stock_expects_book_stock_count_to_increase(): void
    {
        $this->createBook();

        $this->increaseStock($this->getBookId(), 10);

        $responseData = $this->getJsonResponse();
        $this->assertSame(10, $responseData['data']['stock']);
    }

    #[Test]
    public function increase_stock_expects_correct_stock_count_when_increased_twice(): void
    {
        $this->createBook();

        $this->increaseStock($this->getBookId(), amount: 10);
        $this->increaseStock($this->getBookId(), amount: 5);

        $responseData = $this->getJsonResponse();
        $this->assertSame(expected: 15, actual: $responseData['data']['stock']);
    }
}
