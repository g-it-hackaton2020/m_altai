<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200606155643 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE message (id UUID NOT NULL, message_group_id UUID NOT NULL, author_id UUID NOT NULL, reply_id UUID DEFAULT NULL, text TEXT NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6BD307FF7721D56 ON message (message_group_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FF675F31B ON message (author_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F8A0E4E7F ON message (reply_id)');
        $this->addSql('COMMENT ON COLUMN message.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN message.message_group_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN message.author_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN message.reply_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE message_group (id UUID NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN message_group.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF7721D56 FOREIGN KEY (message_group_id) REFERENCES message_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF675F31B FOREIGN KEY (author_id) REFERENCES people (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F8A0E4E7F FOREIGN KEY (reply_id) REFERENCES message (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307F8A0E4E7F');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307FF7721D56');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_group');
    }
}
