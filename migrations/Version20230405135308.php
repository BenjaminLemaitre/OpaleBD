<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405135308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_artwork ADD illustration VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3EAE784107');
        $this->addSql('DROP INDEX IDX_413EEE3EAE784107 ON oeuvres');
        $this->addSql('ALTER TABLE oeuvres CHANGE auteurs_id auteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3E60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteurs (id)');
        $this->addSql('CREATE INDEX IDX_413EEE3E60BB6FE6 ON oeuvres (auteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3E60BB6FE6');
        $this->addSql('DROP INDEX IDX_413EEE3E60BB6FE6 ON oeuvres');
        $this->addSql('ALTER TABLE oeuvres CHANGE auteur_id auteurs_id INT NOT NULL');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3EAE784107 FOREIGN KEY (auteurs_id) REFERENCES auteurs (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_413EEE3EAE784107 ON oeuvres (auteurs_id)');
        $this->addSql('ALTER TABLE category_artwork DROP illustration');
    }
}
