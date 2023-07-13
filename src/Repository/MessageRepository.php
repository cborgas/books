<?php

declare(strict_types=1);

namespace Books\Repository;

use Doctrine\DBAL\Connection;
use EventSauce\EventSourcing\Serialization\MessageSerializer;
use EventSauce\IdEncoding\StringIdEncoder;
use EventSauce\MessageRepository\DoctrineMessageRepository\DoctrineMessageRepository;

class MessageRepository extends DoctrineMessageRepository
{
    private const TABLE_NAME = 'message';

    public function __construct(Connection $connection, MessageSerializer $serializer)
    {
        parent::__construct(
            connection: $connection,
            tableName: self::TABLE_NAME,
            serializer: $serializer,
            aggregateRootIdEncoder: new StringIdEncoder());
    }
}
