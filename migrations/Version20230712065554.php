<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230712065554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create events table for EventSauce';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE event (
                    id SERIAL,
                    event_id UUID NOT NULL,
                    aggregate_root_id UUID NOT NULL,
                    version int8 NULL,
                    payload json NOT NULL,
                    PRIMARY KEY (id),
                    CONSTRAINT reconstitution UNIQUE(aggregate_root_id, version)
                );'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE event');
    }
}
