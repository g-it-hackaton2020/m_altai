<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200606055606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE initiative ADD stad_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE initiative ADD CONSTRAINT FK_E115DEFE59497894 FOREIGN KEY (stad_id) REFERENCES doc_stad (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E115DEFE59497894 ON initiative (stad_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE initiative DROP CONSTRAINT FK_E115DEFE59497894');
        $this->addSql('DROP INDEX IDX_E115DEFE59497894');
        $this->addSql('ALTER TABLE initiative DROP stad_id');
    }
}
