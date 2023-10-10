<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Repository;

use EventSauce\EventSourcing\EventSourcedAggregateRootRepository;
use EventSauce\EventSourcing\MessageDispatcher;
use EventSauce\EventSourcing\MessageRepository;

/**
 * @method \Books\Books\Domain\Model\Book retrieve(\Books\Books\Domain\Model\BookId $aggregateRootId)
 */
class BookRepository extends EventSourcedAggregateRootRepository
{
    public function __construct(MessageRepository $messageRepository, MessageDispatcher $dispatcher = null)
    {
        parent::__construct(\Books\Books\Domain\Model\Book::class, $messageRepository, $dispatcher);
    }
}
