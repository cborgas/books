<?php

namespace Books\Listener;

use Books\Event\Book\StockIncreased;
use Books\Repository\AggregateRoot\BookRepository;
use EventSauce\EventSourcing\Message;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

readonly final class CheckLimitOnStockIncreased
{
    public const LIMIT = 99;
    public function __construct(private BookRepository $bookRepository) {}

    #[AsEventListener(event: StockIncreased::class)]
    public function __invoke(Message $event): void
    {
        $bookId = $event->aggregateRootId();
        $book = $this->bookRepository->retrieve($bookId);
        $book->checkStockLimit(self::LIMIT);
        $this->bookRepository->persist($book);
    }
}