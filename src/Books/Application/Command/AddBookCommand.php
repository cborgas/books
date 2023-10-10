<?php

declare(strict_types=1);

namespace Books\Books\Application\Command;

use Books\Books\Domain\Model\Book;
use Books\Books\Domain\Repository\BookRepositoryInterface;
use Books\Books\Infrastructure\Request\AddBook;

readonly class AddBookCommand
{
    public function __construct(private BookRepositoryInterface $bookRepository) {}

    public function add(AddBook $addBook): Book
    {
        $book = Book::create($addBook->name);
        $this->bookRepository->persist($book);

        return $book;
    }
}