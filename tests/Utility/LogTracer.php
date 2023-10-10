<?php

namespace Books\Tests\Utility;

use Monolog\Handler\Handler;
use Monolog\LogRecord;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LogTracer
{
    private Handler $handler;

    public function __construct(ContainerInterface $container)
    {
        $this->handler = $container->get('monolog.handler.test');
    }

    /**
     * @return array<LogRecord>
     */
    public function getLogsByBook(string $bookId, string $likeMessage = ''): array
    {
        return array_values(
            array_filter(
                $this->handler->getRecords(),
                fn(LogRecord $record) => $record->context['bookId'] ?? null == $bookId
                && str_contains($record->message, $likeMessage)
            )
        );
    }

    public function clearLogs(): void
    {
        $this->handler->clear();
    }
}