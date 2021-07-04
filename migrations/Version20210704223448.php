<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210704223448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD equipments_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEBD251DD7 FOREIGN KEY (equipments_id) REFERENCES equipment (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDEBD251DD7 ON booking (equipments_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEBD251DD7');
        $this->addSql('DROP INDEX IDX_E00CEDDEBD251DD7 ON booking');
        $this->addSql('ALTER TABLE booking DROP equipments_id');
    }
}
