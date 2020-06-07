<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200606165934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE initiative ADD discussions_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN initiative.discussions_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE initiative ADD CONSTRAINT FK_E115DEFE8DDB4304 FOREIGN KEY (discussions_id) REFERENCES message_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E115DEFE8DDB4304 ON initiative (discussions_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE initiative DROP CONSTRAINT FK_E115DEFE8DDB4304');
        $this->addSql('DROP INDEX UNIQ_E115DEFE8DDB4304');
        $this->addSql('ALTER TABLE initiative DROP discussions_id');
    }
}
