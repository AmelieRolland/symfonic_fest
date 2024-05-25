<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524193424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band_register DROP FOREIGN KEY FK_9FB2011E4C8DA834');
        $this->addSql('DROP INDEX IDX_9FB2011E4C8DA834 ON band_register');
        $this->addSql('ALTER TABLE band_register DROP band_register_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band_register ADD band_register_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE band_register ADD CONSTRAINT FK_9FB2011E4C8DA834 FOREIGN KEY (band_register_id) REFERENCES band_register (id)');
        $this->addSql('CREATE INDEX IDX_9FB2011E4C8DA834 ON band_register (band_register_id)');
    }
}
