<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521120927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE band_images (id INT AUTO_INCREMENT NOT NULL, band_id INT DEFAULT NULL, img_name VARCHAR(255) NOT NULL, INDEX IDX_195A83BB49ABEB17 (band_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE band_images ADD CONSTRAINT FK_195A83BB49ABEB17 FOREIGN KEY (band_id) REFERENCES band_register (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band_images DROP FOREIGN KEY FK_195A83BB49ABEB17');
        $this->addSql('DROP TABLE band_images');
    }
}
