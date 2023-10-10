<?php

namespace Books\Books\Domain\Event;

readonly class StockLimitReached
{
    public function __construct(
        public int $stock,
        public int $limit
    ) {
    }
}