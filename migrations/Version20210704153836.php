<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210704153836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE van (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) DEFAULT NULL, type VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD van_id INT NOT NULL, ADD end_station_id INT NOT NULL, ADD end_date DATETIME NOT NULL, CHANGE start_date start_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE8A128D90 FOREIGN KEY (van_id) REFERENCES van (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE2FF5EABB FOREIGN KEY (end_station_id) REFERENCES station (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E00CEDDE8A128D90 ON booking (van_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE2FF5EABB ON booking (end_station_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE8A128D90');
        $this->addSql('DROP TABLE van');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE2FF5EABB');
        $this->addSql('DROP INDEX UNIQ_E00CEDDE8A128D90 ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDE2FF5EABB ON booking');
        $this->addSql('ALTER TABLE booking DROP van_id, DROP end_station_id, DROP end_date, CHANGE start_date start_date VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
