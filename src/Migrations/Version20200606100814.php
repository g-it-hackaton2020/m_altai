<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200606100814 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE "user" ADD people_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN "user".people_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6493147C936 FOREIGN KEY (people_id) REFERENCES people (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6493147C936 ON "user" (people_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6493147C936');
        $this->addSql('DROP INDEX UNIQ_8D93D6493147C936');
        $this->addSql('ALTER TABLE "user" DROP people_id');
    }
}
