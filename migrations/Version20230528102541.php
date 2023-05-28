<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230528102541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_profile CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE contract_type contract_type VARCHAR(255) DEFAULT NULL, CHANGE employer_number employer_number INT DEFAULT NULL, CHANGE dateofbirth dateofbirth VARCHAR(255) DEFAULT NULL, CHANGE countrycode countrycode VARCHAR(255) DEFAULT NULL, CHANGE medicalfilenumber medicalfilenumber INT DEFAULT NULL, CHANGE joindate joindate VARCHAR(255) DEFAULT NULL, CHANGE currentrank currentrank INT DEFAULT NULL, CHANGE upperhierarchy upperhierarchy INT DEFAULT NULL, CHANGE dayoffavailable dayoffavailable INT DEFAULT NULL, CHANGE sickday sickday INT DEFAULT NULL, CHANGE dayout dayout VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_profile CHANGE dateofbirth dateofbirth VARCHAR(180) NOT NULL, CHANGE adresse adresse VARCHAR(180) NOT NULL, CHANGE countrycode countrycode VARCHAR(180) NOT NULL, CHANGE medicalfilenumber medicalfilenumber INT NOT NULL, CHANGE joindate joindate VARCHAR(180) NOT NULL, CHANGE currentrank currentrank INT NOT NULL, CHANGE upperhierarchy upperhierarchy INT NOT NULL, CHANGE dayoffavailable dayoffavailable INT NOT NULL, CHANGE sickday sickday INT NOT NULL, CHANGE dayout dayout VARCHAR(180) NOT NULL, CHANGE contract_type contract_type VARCHAR(180) NOT NULL, CHANGE employer_number employer_number INT NOT NULL');
    }
}
