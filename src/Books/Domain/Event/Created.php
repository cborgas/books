<?php

namespace Books\Books\Domain\Event;

use Books\Books\Domain\Model\BookId;

readonly class Created
{
    public function __construct(
        public BookId $id,
        public string $name,
    ) {
    }
}
