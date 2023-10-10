<?php

namespace Books\Event\Book;

use Books\Books\Domain\BookId;

readonly class Created
{
    public function __construct(
        public BookId $id,
        public string $name,
    ) {
    }
}
