<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200606163552 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE message_likes (message_id UUID NOT NULL, people_id UUID NOT NULL, PRIMARY KEY(message_id, people_id))');
        $this->addSql('CREATE INDEX IDX_B66CB196537A1329 ON message_likes (message_id)');
        $this->addSql('CREATE INDEX IDX_B66CB1963147C936 ON message_likes (people_id)');
        $this->addSql('COMMENT ON COLUMN message_likes.message_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN message_likes.people_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE message_dislikes (message_id UUID NOT NULL, people_id UUID NOT NULL, PRIMARY KEY(message_id, people_id))');
        $this->addSql('CREATE INDEX IDX_24D57A00537A1329 ON message_dislikes (message_id)');
        $this->addSql('CREATE INDEX IDX_24D57A003147C936 ON message_dislikes (people_id)');
        $this->addSql('COMMENT ON COLUMN message_dislikes.message_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN message_dislikes.people_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE message_likes ADD CONSTRAINT FK_B66CB196537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_likes ADD CONSTRAINT FK_B66CB1963147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_dislikes ADD CONSTRAINT FK_24D57A00537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_dislikes ADD CONSTRAINT FK_24D57A003147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE message_likes');
        $this->addSql('DROP TABLE message_dislikes');
    }
}
