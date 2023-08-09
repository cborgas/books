<?php

declare(strict_types=1);

namespace Books\Repository\AggregateRoot;

use EventSauce\EventSourcing\EventSourcedAggregateRootRepository;
use EventSauce\EventSourcing\MessageDispatcher;
use EventSauce\EventSourcing\MessageRepository;

/**
 * @method \Books\Model\Book retrieve(\Books\Model\BookId $aggregateRootId)
 */
class BookRepository extends EventSourcedAggregateRootRepository
{
    public function __construct(MessageRepository $messageRepository, MessageDispatcher $dispatcher = null)
    {
        parent::__construct(\Books\Model\Book::class, $messageRepository, $dispatcher);
    }
}
