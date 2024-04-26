<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426133707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band_register DROP FOREIGN KEY FK_9FB2011E6C32E881');
        $this->addSql('DROP INDEX FK_9FB2011E6C32E881 ON band_register');
        $this->addSql('ALTER TABLE band_register ADD country_id INT NOT NULL, CHANGE music_genre_id music_genre_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE band_register ADD CONSTRAINT FK_9FB2011EF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE band_register ADD CONSTRAINT FK_9FB2011E6C32E881 FOREIGN KEY (music_genre_id_id) REFERENCES music_genre (id)');
        $this->addSql('CREATE INDEX IDX_9FB2011E6C32E881 ON band_register (music_genre_id_id)');
        $this->addSql('CREATE INDEX IDX_9FB2011EF92F3E70 ON band_register (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band_register DROP FOREIGN KEY FK_9FB2011EF92F3E70');
        $this->addSql('ALTER TABLE band_register DROP FOREIGN KEY FK_9FB2011E6C32E881');
        $this->addSql('DROP INDEX IDX_9FB2011E6C32E881 ON band_register');
        $this->addSql('DROP INDEX IDX_9FB2011EF92F3E70 ON band_register');
        $this->addSql('ALTER TABLE band_register ADD music_genre_id INT NOT NULL, DROP music_genre_id_id, DROP country_id');
        $this->addSql('ALTER TABLE band_register ADD CONSTRAINT FK_9FB2011E6C32E881 FOREIGN KEY (music_genre_id) REFERENCES music_genre (id)');
        $this->addSql('CREATE INDEX FK_9FB2011E6C32E881 ON band_register (music_genre_id)');
    }
}
