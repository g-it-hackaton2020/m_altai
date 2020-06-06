<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200606063732 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE initiative_community_group (initiative_id UUID NOT NULL, community_group_id UUID NOT NULL, PRIMARY KEY(initiative_id, community_group_id))');
        $this->addSql('CREATE INDEX IDX_7401091AAB7D9771 ON initiative_community_group (initiative_id)');
        $this->addSql('CREATE INDEX IDX_7401091AC121C60 ON initiative_community_group (community_group_id)');
        $this->addSql('COMMENT ON COLUMN initiative_community_group.initiative_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN initiative_community_group.community_group_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE petition_community_group (petition_id UUID NOT NULL, community_group_id UUID NOT NULL, PRIMARY KEY(petition_id, community_group_id))');
        $this->addSql('CREATE INDEX IDX_666383A1AEC7D346 ON petition_community_group (petition_id)');
        $this->addSql('CREATE INDEX IDX_666383A1C121C60 ON petition_community_group (community_group_id)');
        $this->addSql('COMMENT ON COLUMN petition_community_group.petition_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN petition_community_group.community_group_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE initiative_community_group ADD CONSTRAINT FK_7401091AAB7D9771 FOREIGN KEY (initiative_id) REFERENCES initiative (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE initiative_community_group ADD CONSTRAINT FK_7401091AC121C60 FOREIGN KEY (community_group_id) REFERENCES community_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE petition_community_group ADD CONSTRAINT FK_666383A1AEC7D346 FOREIGN KEY (petition_id) REFERENCES petition (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE petition_community_group ADD CONSTRAINT FK_666383A1C121C60 FOREIGN KEY (community_group_id) REFERENCES community_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE initiative_community_group');
        $this->addSql('DROP TABLE petition_community_group');
    }
}
