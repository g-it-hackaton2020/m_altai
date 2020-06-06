<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200606070049 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE petition_community_group');
        $this->addSql('ALTER TABLE petition ADD community_group_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN petition.community_group_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE petition ADD CONSTRAINT FK_FF598B03C121C60 FOREIGN KEY (community_group_id) REFERENCES community_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FF598B03C121C60 ON petition (community_group_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE petition_community_group (petition_id UUID NOT NULL, community_group_id UUID NOT NULL, PRIMARY KEY(petition_id, community_group_id))');
        $this->addSql('CREATE INDEX idx_666383a1c121c60 ON petition_community_group (community_group_id)');
        $this->addSql('CREATE INDEX idx_666383a1aec7d346 ON petition_community_group (petition_id)');
        $this->addSql('COMMENT ON COLUMN petition_community_group.petition_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN petition_community_group.community_group_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE petition_community_group ADD CONSTRAINT fk_666383a1aec7d346 FOREIGN KEY (petition_id) REFERENCES petition (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE petition_community_group ADD CONSTRAINT fk_666383a1c121c60 FOREIGN KEY (community_group_id) REFERENCES community_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE petition DROP CONSTRAINT FK_FF598B03C121C60');
        $this->addSql('DROP INDEX IDX_FF598B03C121C60');
        $this->addSql('ALTER TABLE petition DROP community_group_id');
    }
}
