<?php

namespace Books\Framework\EventSauce;

use EventSauce\EventSourcing\Message;
use EventSauce\EventSourcing\MessageConsumer;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

readonly class EventDispatcher implements MessageConsumer
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
        private LoggerInterface $logger
    ) {
    }

    public function handle(Message $message): void
    {
        $this->logger->debug('Dispatching event', ['event' => $message->payload(), 'headers' => $message->headers()]);
        $this->eventDispatcher->dispatch($message, get_class($message->payload()));
    }
}