<?php

declare(strict_types=1);

namespace Books\Repository;

use Doctrine\DBAL\Connection;
use EventSauce\EventSourcing\Serialization\MessageSerializer;
use EventSauce\MessageRepository\DoctrineMessageRepository\DoctrineMessageRepository;

class MessageRepository extends DoctrineMessageRepository
{
    private const TABLE_NAME = 'event';

    public function __construct(Connection $connection, MessageSerializer $serializer)
    {
        parent::__construct($connection, self::TABLE_NAME, $serializer);
    }
}
