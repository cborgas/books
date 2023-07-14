<?php

namespace Books\Event\Book;

readonly class StockIncreased
{
    public function __construct(
        public int $amount,
    ) {}
}
