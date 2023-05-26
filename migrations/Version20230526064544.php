<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230526064544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_profile ADD idconge INT NOT NULL, ADD dateofbirth VARCHAR(180) NOT NULL, ADD countrycode VARCHAR(180) NOT NULL, ADD medicalfilenumber INT NOT NULL, ADD joindate VARCHAR(180) NOT NULL, ADD currentrank INT NOT NULL, ADD upperhierarchy INT NOT NULL, ADD dayoffavailable INT NOT NULL, ADD sickday INT NOT NULL, ADD dayout VARCHAR(180) NOT NULL, DROP id_conge, DROP date_of_birth, DROP country_code, DROP medical_file_number, DROP join_date, DROP current_rank, DROP upper_hierarchy, DROP day_off_available, DROP sick_day, DROP day_out');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_profile ADD id_conge INT NOT NULL, ADD date_of_birth VARCHAR(180) NOT NULL, ADD country_code VARCHAR(180) NOT NULL, ADD medical_file_number INT NOT NULL, ADD join_date VARCHAR(180) NOT NULL, ADD current_rank INT NOT NULL, ADD upper_hierarchy INT NOT NULL, ADD day_off_available INT NOT NULL, ADD sick_day INT NOT NULL, ADD day_out VARCHAR(180) NOT NULL, DROP idconge, DROP dateofbirth, DROP countrycode, DROP medicalfilenumber, DROP joindate, DROP currentrank, DROP upperhierarchy, DROP dayoffavailable, DROP sickday, DROP dayout');
    }
}
