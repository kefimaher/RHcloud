<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523210205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD employer_number_id INT DEFAULT NULL, DROP employer_number');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B2FC671A FOREIGN KEY (employer_number_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649B2FC671A ON user (employer_number_id)');
        $this->addSql('ALTER TABLE user_profile DROP FOREIGN KEY FK_D95AB405B2FC671A');
        $this->addSql('DROP INDEX UNIQ_D95AB405B2FC671A ON user_profile');
        $this->addSql('ALTER TABLE user_profile ADD employer_number VARCHAR(180) NOT NULL, DROP employer_number_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B2FC671A');
        $this->addSql('DROP INDEX UNIQ_8D93D649B2FC671A ON user');
        $this->addSql('ALTER TABLE user ADD employer_number INT NOT NULL, DROP employer_number_id');
        $this->addSql('ALTER TABLE user_profile ADD employer_number_id INT DEFAULT NULL, DROP employer_number');
        $this->addSql('ALTER TABLE user_profile ADD CONSTRAINT FK_D95AB405B2FC671A FOREIGN KEY (employer_number_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D95AB405B2FC671A ON user_profile (employer_number_id)');
    }
}
