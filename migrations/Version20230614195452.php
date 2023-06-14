<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230614195452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reception CHANGE question question VARCHAR(255) DEFAULT NULL, CHANGE statut statut VARCHAR(255) DEFAULT NULL, CHANGE repence repence VARCHAR(255) DEFAULT NULL, CHANGE datequestion datequestion VARCHAR(255) DEFAULT NULL, CHANGE datereponce datereponce VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reception CHANGE question question VARCHAR(180) NOT NULL, CHANGE statut statut VARCHAR(180) NOT NULL, CHANGE repence repence VARCHAR(180) NOT NULL, CHANGE datequestion datequestion VARCHAR(180) NOT NULL, CHANGE datereponce datereponce VARCHAR(180) NOT NULL');
    }
}
