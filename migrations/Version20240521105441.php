<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521105441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prog_day DROP FOREIGN KEY FK_E9BA765F49ABEB17');
        $this->addSql('DROP INDEX IDX_E9BA765F49ABEB17 ON prog_day');
        $this->addSql('ALTER TABLE prog_day CHANGE band_id band_register_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prog_day ADD CONSTRAINT FK_E9BA765F4C8DA834 FOREIGN KEY (band_register_id) REFERENCES band_register (id)');
        $this->addSql('CREATE INDEX IDX_E9BA765F4C8DA834 ON prog_day (band_register_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prog_day DROP FOREIGN KEY FK_E9BA765F4C8DA834');
        $this->addSql('DROP INDEX IDX_E9BA765F4C8DA834 ON prog_day');
        $this->addSql('ALTER TABLE prog_day CHANGE band_register_id band_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prog_day ADD CONSTRAINT FK_E9BA765F49ABEB17 FOREIGN KEY (band_id) REFERENCES band_register (id)');
        $this->addSql('CREATE INDEX IDX_E9BA765F49ABEB17 ON prog_day (band_id)');
    }
}
