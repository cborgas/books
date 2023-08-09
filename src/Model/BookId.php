<?php

declare(strict_types=1);

namespace Books\Model;

use EventSauce\EventSourcing\AggregateRootId;
use EventSauce\ObjectHydrator\Constructor;
use EventSauce\ObjectHydrator\DoNotSerialize;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class BookId implements AggregateRootId
{
    public function __construct(private UuidInterface $id) {}

    #[Constructor]
    public static function fromString(string $id): static
    {
        return new static(Uuid::fromString($id));
    }

    public static function create(): static
    {
        return new static(Uuid::uuid4());
    }

    public function id(): string
    {
        return $this->toString();
    }

    #[DoNotSerialize]
    public function toString(): string
    {
        return $this->id->toString();
    }
}
