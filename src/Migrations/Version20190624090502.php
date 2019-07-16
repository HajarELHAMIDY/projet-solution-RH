<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190624090502 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, comment LONGTEXT NOT NULL, create_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, jobcity_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2D5B0234229BA8AD (jobcity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, job_statut_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, code VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL, INDEX IDX_FBD8E0F83190D715 (job_statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, time DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, statut_app_id INT DEFAULT NULL, name_statut VARCHAR(255) NOT NULL, INDEX IDX_E564F0BFCE088079 (statut_app_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234229BA8AD FOREIGN KEY (jobcity_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F83190D715 FOREIGN KEY (job_statut_id) REFERENCES application (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFCE088079 FOREIGN KEY (statut_app_id) REFERENCES application (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F83190D715');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFCE088079');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234229BA8AD');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE statut');
    }
}
