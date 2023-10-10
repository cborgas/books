<?php

namespace Books\Tests\Integration\Listener;

use Books\Tests\Integration\Controller\Book\BookControllerTestCase;
use Books\Tests\Utility\LogTracer;
use PHPUnit\Framework\Attributes\Test;

class NotifyOnStockLimitTest extends BookControllerTestCase
{
    private LogTracer $logTracer;

    public function setUp(): void
    {
        parent::setUp();
        $this->logTracer = new LogTracer($this->getContainer());
        $this->logTracer->clearLogs();
    }

    #[Test]
    public function increaseStockExpectsNotificationWhenLimitIsReached(): void
    {
        $this->createBook();
        $bookId = $this->getBookId();

        $this->increaseStock($bookId, 99);

        $logs = $this->logTracer->getLogsByBook($bookId, likeMessage: 'Stock limit reached');
        $this->assertSame('Stock limit reached', $logs[0]->message);
        $this->assertSame(['bookId' => $bookId], $logs[0]->context);
        $this->assertSame('notice', $logs[0]->level->toPsrLogLevel());
    }
}