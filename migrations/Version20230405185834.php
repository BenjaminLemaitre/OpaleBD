<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405185834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteurs_category_artwork DROP FOREIGN KEY FK_DA2490E92BA6AFDA');
        $this->addSql('ALTER TABLE auteurs_category_artwork DROP FOREIGN KEY FK_DA2490E9AE784107');
        $this->addSql('DROP TABLE auteurs_category_artwork');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteurs_category_artwork (auteurs_id INT NOT NULL, category_artwork_id INT NOT NULL, INDEX IDX_DA2490E92BA6AFDA (category_artwork_id), INDEX IDX_DA2490E9AE784107 (auteurs_id), PRIMARY KEY(auteurs_id, category_artwork_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE auteurs_category_artwork ADD CONSTRAINT FK_DA2490E92BA6AFDA FOREIGN KEY (category_artwork_id) REFERENCES category_artwork (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE auteurs_category_artwork ADD CONSTRAINT FK_DA2490E9AE784107 FOREIGN KEY (auteurs_id) REFERENCES auteurs (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
