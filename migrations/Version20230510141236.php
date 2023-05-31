<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510141236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE manif (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, affiche VARCHAR(255) NOT NULL, date DATETIME NOT NULL, datefin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manif_category_artwork (manif_id INT NOT NULL, category_artwork_id INT NOT NULL, INDEX IDX_A1ACF3DC229CE2B9 (manif_id), INDEX IDX_A1ACF3DC2BA6AFDA (category_artwork_id), PRIMARY KEY(manif_id, category_artwork_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manif_auteurs (manif_id INT NOT NULL, auteurs_id INT NOT NULL, INDEX IDX_89C85C51229CE2B9 (manif_id), INDEX IDX_89C85C51AE784107 (auteurs_id), PRIMARY KEY(manif_id, auteurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE manif_category_artwork ADD CONSTRAINT FK_A1ACF3DC229CE2B9 FOREIGN KEY (manif_id) REFERENCES manif (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE manif_category_artwork ADD CONSTRAINT FK_A1ACF3DC2BA6AFDA FOREIGN KEY (category_artwork_id) REFERENCES category_artwork (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE manif_auteurs ADD CONSTRAINT FK_89C85C51229CE2B9 FOREIGN KEY (manif_id) REFERENCES manif (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE manif_auteurs ADD CONSTRAINT FK_89C85C51AE784107 FOREIGN KEY (auteurs_id) REFERENCES auteurs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE manif_category_artwork DROP FOREIGN KEY FK_A1ACF3DC229CE2B9');
        $this->addSql('ALTER TABLE manif_category_artwork DROP FOREIGN KEY FK_A1ACF3DC2BA6AFDA');
        $this->addSql('ALTER TABLE manif_auteurs DROP FOREIGN KEY FK_89C85C51229CE2B9');
        $this->addSql('ALTER TABLE manif_auteurs DROP FOREIGN KEY FK_89C85C51AE784107');
        $this->addSql('DROP TABLE manif');
        $this->addSql('DROP TABLE manif_category_artwork');
        $this->addSql('DROP TABLE manif_auteurs');
    }
}
