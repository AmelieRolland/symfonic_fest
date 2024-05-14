<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513130653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prog_day (id INT AUTO_INCREMENT NOT NULL, days_id INT NOT NULL, hour TIME NOT NULL, INDEX IDX_E9BA765F3575FA99 (days_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prog_day_scene (prog_day_id INT NOT NULL, scene_id INT NOT NULL, INDEX IDX_CF7E9DA537028B6 (prog_day_id), INDEX IDX_CF7E9DA166053B4 (scene_id), PRIMARY KEY(prog_day_id, scene_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prog_day ADD CONSTRAINT FK_E9BA765F3575FA99 FOREIGN KEY (days_id) REFERENCES days (id)');
        $this->addSql('ALTER TABLE prog_day_scene ADD CONSTRAINT FK_CF7E9DA537028B6 FOREIGN KEY (prog_day_id) REFERENCES prog_day (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prog_day_scene ADD CONSTRAINT FK_CF7E9DA166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE band_register ADD prog_day_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE band_register ADD CONSTRAINT FK_9FB2011E537028B6 FOREIGN KEY (prog_day_id) REFERENCES prog_day (id)');
        $this->addSql('CREATE INDEX IDX_9FB2011E537028B6 ON band_register (prog_day_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE band_register DROP FOREIGN KEY FK_9FB2011E537028B6');
        $this->addSql('ALTER TABLE prog_day DROP FOREIGN KEY FK_E9BA765F3575FA99');
        $this->addSql('ALTER TABLE prog_day_scene DROP FOREIGN KEY FK_CF7E9DA537028B6');
        $this->addSql('ALTER TABLE prog_day_scene DROP FOREIGN KEY FK_CF7E9DA166053B4');
        $this->addSql('DROP TABLE prog_day');
        $this->addSql('DROP TABLE prog_day_scene');
        $this->addSql('DROP INDEX IDX_9FB2011E537028B6 ON band_register');
        $this->addSql('ALTER TABLE band_register DROP prog_day_id');
    }
}
