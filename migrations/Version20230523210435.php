<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523210435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B2FC671A');
        $this->addSql('DROP INDEX UNIQ_8D93D649B2FC671A ON user');
        $this->addSql('ALTER TABLE user CHANGE employer_number_id user_profile_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649661EACD5 FOREIGN KEY (user_profile_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649661EACD5 ON user (user_profile_id_id)');
        $this->addSql('ALTER TABLE user_profile CHANGE employer_number employer_number INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649661EACD5');
        $this->addSql('DROP INDEX UNIQ_8D93D649661EACD5 ON user');
        $this->addSql('ALTER TABLE user CHANGE user_profile_id_id employer_number_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B2FC671A FOREIGN KEY (employer_number_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649B2FC671A ON user (employer_number_id)');
        $this->addSql('ALTER TABLE user_profile CHANGE employer_number employer_number VARCHAR(180) NOT NULL');
    }
}
