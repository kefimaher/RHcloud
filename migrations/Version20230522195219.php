<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522195219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_profile (id INT AUTO_INCREMENT NOT NULL, employer_number INT NOT NULL, id_conge INT NOT NULL, avatar VARCHAR(180) NOT NULL, date_of_birth VARCHAR(180) NOT NULL, adresse VARCHAR(180) NOT NULL, country_code VARCHAR(180) NOT NULL, medical_file_number INT NOT NULL, join_date VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, current_rank INT NOT NULL, upper_hierarchy INT NOT NULL, day_off_available INT NOT NULL, sick_day INT NOT NULL, day_out VARCHAR(180) NOT NULL, contract_type VARCHAR(180) NOT NULL, status VARCHAR(180) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_profile');
    }
}
