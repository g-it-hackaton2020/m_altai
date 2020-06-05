<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200605100726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE petition (id UUID NOT NULL, petition_type_id UUID NOT NULL, autor_id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FF598B03547F4AB6 ON petition (petition_type_id)');
        $this->addSql('CREATE INDEX IDX_FF598B0314D45BBE ON petition (autor_id)');
        $this->addSql('COMMENT ON COLUMN petition.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN petition.petition_type_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN petition.autor_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE petition_people (petition_id UUID NOT NULL, people_id UUID NOT NULL, PRIMARY KEY(petition_id, people_id))');
        $this->addSql('CREATE INDEX IDX_7FBCD868AEC7D346 ON petition_people (petition_id)');
        $this->addSql('CREATE INDEX IDX_7FBCD8683147C936 ON petition_people (people_id)');
        $this->addSql('COMMENT ON COLUMN petition_people.petition_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN petition_people.people_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE petition_type (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN petition_type.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE petition ADD CONSTRAINT FK_FF598B03547F4AB6 FOREIGN KEY (petition_type_id) REFERENCES petition_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE petition ADD CONSTRAINT FK_FF598B0314D45BBE FOREIGN KEY (autor_id) REFERENCES people (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE petition_people ADD CONSTRAINT FK_7FBCD868AEC7D346 FOREIGN KEY (petition_id) REFERENCES petition (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE petition_people ADD CONSTRAINT FK_7FBCD8683147C936 FOREIGN KEY (people_id) REFERENCES people (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE petition_people DROP CONSTRAINT FK_7FBCD868AEC7D346');
        $this->addSql('ALTER TABLE petition DROP CONSTRAINT FK_FF598B03547F4AB6');
        $this->addSql('DROP TABLE petition');
        $this->addSql('DROP TABLE petition_people');
        $this->addSql('DROP TABLE petition_type');
    }
}
