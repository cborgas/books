<?php

declare(strict_types=1);

namespace Books\Model;

use Books\Event\Book\Created;
use Books\Event\Book\StockIncreased;
use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

class Book implements AggregateRoot
{
    use AggregateRootBehaviour;

    private readonly BookId $id;

    private string $name;

    private int $stock = 0;

    public static function create(string $name): Book
    {
        $id = BookId::create();
        $book = new static($id);
        $book->recordThat(new Created($id, $name));

        return $book;
    }

    public function increaseStock(int $amount): void
    {
        $this->recordThat(new StockIncreased($amount));
    }

    public function applyCreated(Created $event): void
    {
        $this->name = $event->name;
        $this->id = $event->id;
    }

    public function applyStockIncreased(StockIncreased $event): void
    {
        $this->stock += $event->amount;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): BookId
    {
        return $this->id;
    }

    public function getStock(): int
    {
        return $this->stock;
    }
}
