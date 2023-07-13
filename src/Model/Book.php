<?php

declare(strict_types=1);

namespace Books\Model;

use Books\Event\Book\Created;
use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

class Book implements AggregateRoot
{
    use AggregateRootBehaviour;

    private readonly BookId $id;

    private ?string $name;

    public static function create(string $name): Book
    {
        $id = BookId::create();
        $book = new static($id);
        $book->recordThat(new Created($id, $name));

        return $book;
    }

    public function applyCreated(Created $event): void
    {
        $this->name = $event->name;
        $this->id = $event->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): BookId
    {
        return $this->id;
    }
}
