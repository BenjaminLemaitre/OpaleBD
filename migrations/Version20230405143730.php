<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405143730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvres ADD series_id INT NOT NULL, DROP series');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3E5278319C FOREIGN KEY (series_id) REFERENCES series (id)');
        $this->addSql('CREATE INDEX IDX_413EEE3E5278319C ON oeuvres (series_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3E5278319C');
        $this->addSql('DROP INDEX IDX_413EEE3E5278319C ON oeuvres');
        $this->addSql('ALTER TABLE oeuvres ADD series VARCHAR(255) NOT NULL, DROP series_id');
    }
}
