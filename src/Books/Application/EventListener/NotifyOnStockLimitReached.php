<?php

namespace Books\Books\Application\EventListener;

use Books\Books\Domain\Event\StockLimitReached;
use EventSauce\EventSourcing\Message;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

readonly final class NotifyOnStockLimitReached
{
    public function __construct(private LoggerInterface $logger) {}

    #[AsEventListener(event: StockLimitReached::class)]
    public function __invoke(Message $event): void
    {
        $this->logger->notice('Stock limit reached', [
            'bookId' => $event->aggregateRootId()->toString(),
        ]);
    }
}
