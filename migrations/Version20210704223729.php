<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210704223729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEBD251DD7');
        $this->addSql('DROP INDEX IDX_E00CEDDEBD251DD7 ON booking');
        $this->addSql('ALTER TABLE booking DROP equipments_id');
        $this->addSql('ALTER TABLE equipment ADD booking_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D5833301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('CREATE INDEX IDX_D338D5833301C60 ON equipment (booking_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD equipments_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEBD251DD7 FOREIGN KEY (equipments_id) REFERENCES equipment (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDEBD251DD7 ON booking (equipments_id)');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D5833301C60');
        $this->addSql('DROP INDEX IDX_D338D5833301C60 ON equipment');
        $this->addSql('ALTER TABLE equipment DROP booking_id');
    }
}
