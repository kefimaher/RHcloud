<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230526063116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64990FEAF0A');
        $this->addSql('DROP INDEX UNIQ_8D93D64990FEAF0A ON user');
        $this->addSql('ALTER TABLE user CHANGE iduserprofile_id userprofile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64981863E41 FOREIGN KEY (userprofile_id) REFERENCES user_profile (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64981863E41 ON user (userprofile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64981863E41');
        $this->addSql('DROP INDEX UNIQ_8D93D64981863E41 ON user');
        $this->addSql('ALTER TABLE user CHANGE userprofile_id iduserprofile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64990FEAF0A FOREIGN KEY (iduserprofile_id) REFERENCES user_profile (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64990FEAF0A ON user (iduserprofile_id)');
    }
}
