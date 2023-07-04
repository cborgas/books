<?php

namespace Books\Event\Book;

use Books\Model\BookId;
use Ramsey\Uuid\UuidInterface;

readonly class Created
{
    public function __construct(
        public BookId $id,
        public string $name,
    ) {}
}
