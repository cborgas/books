<?php

declare(strict_types=1);

namespace Books\Books\Domain;

use Books\Event\Book\Created;
use Books\Event\Book\StockIncreased;
use Books\Event\Book\StockLimitReached;
use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;
use JsonSerializable;

class Book implements AggregateRoot, JsonSerializable
{
    use AggregateRootBehaviour;

    private readonly BookId $id;

    private string $name;

    private int $stock = 0;

    private bool $created = false;

    private bool $stockLimitReached = false;

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
        $this->created = true;
    }

    public function applyStockIncreased(StockIncreased $event): void
    {
        $this->stock += $event->amount;
    }

    public function checkStockLimit(int $limit): void
    {
        if ($this->stock === $limit) {
            $this->recordThat(new StockLimitReached($this->stock, $limit));
        }
    }

    public function applyStockLimitReached(StockLimitReached $event): void
    {
        $this->stockLimitReached = true;
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

    public function isCreated(): bool
    {
        return $this->created;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->toString(),
            'name' => $this->name,
            'stock' => $this->stock,
        ];
    }
}
