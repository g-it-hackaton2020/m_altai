<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200606172920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE people ADD trusted_leader_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN people.trusted_leader_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE people ADD CONSTRAINT FK_28166A26D2F213CD FOREIGN KEY (trusted_leader_id) REFERENCES people (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_28166A26D2F213CD ON people (trusted_leader_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE people DROP CONSTRAINT FK_28166A26D2F213CD');
        $this->addSql('DROP INDEX IDX_28166A26D2F213CD');
        $this->addSql('ALTER TABLE people DROP trusted_leader_id');
    }
}
