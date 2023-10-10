<?php

namespace Books\Event\Book;

readonly class StockLimitReached
{
    public function __construct(
        public int $stock,
        public int $limit
    ) {
    }
}