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
}
