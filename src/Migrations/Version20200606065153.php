<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200606065153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE initiative_community_group');
        $this->addSql('ALTER TABLE initiative ADD community_group_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN initiative.community_group_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE initiative ADD CONSTRAINT FK_E115DEFEC121C60 FOREIGN KEY (community_group_id) REFERENCES community_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E115DEFEC121C60 ON initiative (community_group_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE initiative_community_group (initiative_id UUID NOT NULL, community_group_id UUID NOT NULL, PRIMARY KEY(initiative_id, community_group_id))');
        $this->addSql('CREATE INDEX idx_7401091aab7d9771 ON initiative_community_group (initiative_id)');
        $this->addSql('CREATE INDEX idx_7401091ac121c60 ON initiative_community_group (community_group_id)');
        $this->addSql('COMMENT ON COLUMN initiative_community_group.initiative_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN initiative_community_group.community_group_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE initiative_community_group ADD CONSTRAINT fk_7401091aab7d9771 FOREIGN KEY (initiative_id) REFERENCES initiative (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE initiative_community_group ADD CONSTRAINT fk_7401091ac121c60 FOREIGN KEY (community_group_id) REFERENCES community_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE initiative DROP CONSTRAINT FK_E115DEFEC121C60');
        $this->addSql('DROP INDEX IDX_E115DEFEC121C60');
        $this->addSql('ALTER TABLE initiative DROP community_group_id');
    }
}
