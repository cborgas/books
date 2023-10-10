<?php

namespace Books\Books\Domain\Event;

readonly class StockIncreased
{
    public function __construct(
        public int $amount,
    ) {
    }
}
