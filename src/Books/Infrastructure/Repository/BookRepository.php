<?php

declare(strict_types=1);

namespace Books\Books\Infrastructure\Repository;

use Books\Books\Domain\Model\Book;
use Books\Books\Domain\Model\BookId;
use Books\Books\Domain\Repository\BookRepositoryInterface;
use EventSauce\EventSourcing\EventSourcedAggregateRootRepository;
use EventSauce\EventSourcing\MessageDispatcher;
use EventSauce\EventSourcing\MessageRepository;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;

#[AsAlias(BookRepositoryInterface::class)]
class BookRepository extends EventSourcedAggregateRootRepository implements BookRepositoryInterface
{
    public function __construct(MessageRepository $messageRepository, MessageDispatcher $dispatcher = null)
    {
        parent::__construct(Book::class, $messageRepository, $dispatcher);
    }

    public function findOneById(BookId $id): Book
    {
        return $this->retrieve($id);
    }
}
