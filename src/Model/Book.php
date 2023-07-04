<?php

declare(strict_types=1);

namespace Books\Model;

use Books\Event\Book\Created;
use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

class Book implements AggregateRoot
{
    use AggregateRootBehaviour;

    private ?string $name;

    public static function create(BookId $id, string $name): Book
    {
        $book = new static($id);
        $book->recordThat(new Created($id, $name));

        return $book;
    }

    public function applyCreated(Created $event): void
    {
        $this->name = $event->name();
    }

    public function getName(): string
    {
        return $this->name;
    }
}
