<?php

declare(strict_types=1);

namespace Books\Model;

use EventSauce\EventSourcing\AggregateRootId;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class BookId implements AggregateRootId
{
    public function __construct(private UuidInterface $uuid) {}

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public static function create(): static
    {
        return new static(Uuid::uuid4());
    }

    public static function fromString(string $aggregateRootId): static
    {
        return new static(Uuid::fromString($aggregateRootId));
    }
}
