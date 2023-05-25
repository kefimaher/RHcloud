<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525183133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conge ADD user_profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conge ADD CONSTRAINT FK_2ED893486B9DD454 FOREIGN KEY (user_profile_id) REFERENCES user_profile (id)');
        $this->addSql('CREATE INDEX IDX_2ED893486B9DD454 ON conge (user_profile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conge DROP FOREIGN KEY FK_2ED893486B9DD454');
        $this->addSql('DROP INDEX IDX_2ED893486B9DD454 ON conge');
        $this->addSql('ALTER TABLE conge DROP user_profile_id');
    }
}
