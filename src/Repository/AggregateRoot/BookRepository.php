<?php

declare(strict_types=1);

namespace Books\Repository\AggregateRoot;

use EventSauce\EventSourcing\EventSourcedAggregateRootRepository;
use EventSauce\EventSourcing\MessageDispatcher;
use EventSauce\EventSourcing\MessageRepository;

/**
 * @method \Books\Books\Domain\Book retrieve(\Books\Books\Domain\BookId $aggregateRootId)
 */
class BookRepository extends EventSourcedAggregateRootRepository
{
    public function __construct(MessageRepository $messageRepository, MessageDispatcher $dispatcher = null)
    {
        parent::__construct(\Books\Books\Domain\Book::class, $messageRepository, $dispatcher);
    }
}
