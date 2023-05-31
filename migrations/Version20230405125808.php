<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405125808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteurs (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, illustration VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oeuvres (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, auteur_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, illustration VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_413EEE3E12469DE2 (category_id), INDEX IDX_413EEE3E60BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3E12469DE2 FOREIGN KEY (category_id) REFERENCES category_artwork (id)');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3E60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteurs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3E12469DE2');
        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3E60BB6FE6');
        $this->addSql('DROP TABLE auteurs');
        $this->addSql('DROP TABLE oeuvres');
    }
}
