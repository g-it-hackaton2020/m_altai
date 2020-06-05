<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200603161024 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE community_group (id UUID NOT NULL, lead_id UUID NOT NULL, community_name VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_16B03E8155458D ON community_group (lead_id)');
        $this->addSql('COMMENT ON COLUMN community_group.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN community_group.lead_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE community_group_people (community_group_id UUID NOT NULL, people_id UUID NOT NULL, PRIMARY KEY(community_group_id, people_id))');
        $this->addSql('CREATE INDEX IDX_A4810A69C121C60 ON community_group_people (community_group_id)');
        $this->addSql('CREATE INDEX IDX_A4810A693147C936 ON community_group_people (people_id)');
        $this->addSql('COMMENT ON COLUMN community_group_people.community_group_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN community_group_people.people_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE community_group ADD CONSTRAINT FK_16B03E8155458D FOREIGN KEY (lead_id) REFERENCES people (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE community_group_people ADD CONSTRAINT FK_A4810A69C121C60 FOREIGN KEY (community_group_id) REFERENCES community_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE community_group_people ADD CONSTRAINT FK_A4810A693147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE community_group_people DROP CONSTRAINT FK_A4810A69C121C60');
        $this->addSql('DROP TABLE community_group');
        $this->addSql('DROP TABLE community_group_people');
    }
}
