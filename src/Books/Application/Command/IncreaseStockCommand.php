<?php

declare(strict_types=1);

namespace Books\Books\Application\Command;

use Books\Books\Domain\Model\Book;
use Books\Books\Infrastructure\Repository\BookRepository;
use Books\Books\Infrastructure\Request\IncreaseStock;
readonly class IncreaseStockCommand
{
    public function __construct(private BookRepository $bookRepository) {}

    public function increaseStock(Book $book, IncreaseStock $increaseStockCommand): void
    {
        $book->increaseStock($increaseStockCommand->amount);
        $this->bookRepository->persist($book);
    }
}