<?php

namespace Books\Event\Book;

use Books\Model\BookId;
use Ramsey\Uuid\UuidInterface;

readonly class Created
{
    public function __construct(
        private BookId $id,
        private string $name,
    ) {}
    public function id(): BookId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
