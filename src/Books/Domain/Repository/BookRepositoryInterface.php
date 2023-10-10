<?php

declare(strict_types=1);

namespace Books\Books\Domain\Repository;

use Books\Books\Domain\Model\Book;
use Books\Books\Domain\Model\BookId;

interface BookRepositoryInterface
{
    public function findOneById(BookId $id): Book;

    public function persist(Book $book): void;
}