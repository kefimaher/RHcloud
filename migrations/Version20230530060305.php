<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230530060305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conge CHANGE start_day start_day VARCHAR(255) DEFAULT NULL, CHANGE end_day end_day VARCHAR(255) DEFAULT NULL, CHANGE type_conge type_conge VARCHAR(255) DEFAULT NULL, CHANGE cretification cretification VARCHAR(255) DEFAULT NULL, CHANGE day_number day_number LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', CHANGE statuts statuts VARCHAR(255) DEFAULT NULL, CHANGE discription discription VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conge CHANGE start_day start_day VARCHAR(255) NOT NULL, CHANGE end_day end_day VARCHAR(255) NOT NULL, CHANGE type_conge type_conge VARCHAR(255) NOT NULL, CHANGE cretification cretification VARCHAR(255) NOT NULL, CHANGE day_number day_number LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE statuts statuts VARCHAR(255) NOT NULL, CHANGE discription discription VARCHAR(255) NOT NULL');
    }
}
