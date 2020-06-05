<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200605131028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE initiative (id UUID NOT NULL, initiative_type_id UUID NOT NULL, autor_id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E115DEFEE6B66EC9 ON initiative (initiative_type_id)');
        $this->addSql('CREATE INDEX IDX_E115DEFE14D45BBE ON initiative (autor_id)');
        $this->addSql('COMMENT ON COLUMN initiative.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN initiative.initiative_type_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN initiative.autor_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE initiative_people (initiative_id UUID NOT NULL, people_id UUID NOT NULL, PRIMARY KEY(initiative_id, people_id))');
        $this->addSql('CREATE INDEX IDX_B938FD1AB7D9771 ON initiative_people (initiative_id)');
        $this->addSql('CREATE INDEX IDX_B938FD13147C936 ON initiative_people (people_id)');
        $this->addSql('COMMENT ON COLUMN initiative_people.initiative_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN initiative_people.people_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE initiative ADD CONSTRAINT FK_E115DEFEE6B66EC9 FOREIGN KEY (initiative_type_id) REFERENCES petition_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE initiative ADD CONSTRAINT FK_E115DEFE14D45BBE FOREIGN KEY (autor_id) REFERENCES people (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE initiative_people ADD CONSTRAINT FK_B938FD1AB7D9771 FOREIGN KEY (initiative_id) REFERENCES initiative (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE initiative_people ADD CONSTRAINT FK_B938FD13147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE initiative_people DROP CONSTRAINT FK_B938FD1AB7D9771');
        $this->addSql('DROP TABLE initiative');
        $this->addSql('DROP TABLE initiative_people');
    }
}
