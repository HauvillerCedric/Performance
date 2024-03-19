<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240304094521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actuality (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_4093DDD8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(20) NOT NULL, last_name VARCHAR(30) NOT NULL, mobile VARCHAR(20) NOT NULL, email VARCHAR(80) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gateway (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, inscription_fee DOUBLE PRECISION NOT NULL, driving DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_14FEDD7FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE licence (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(80) NOT NULL, inscription_fee DOUBLE PRECISION NOT NULL, book DOUBLE PRECISION NOT NULL, card DOUBLE PRECISION NOT NULL, code_book DOUBLE PRECISION DEFAULT NULL, inscpections_book DOUBLE PRECISION DEFAULT NULL, code_package DOUBLE PRECISION DEFAULT NULL, driving DOUBLE PRECISION NOT NULL, code_test DOUBLE PRECISION DEFAULT NULL, driving_test DOUBLE PRECISION DEFAULT NULL, inspection_workshop DOUBLE PRECISION DEFAULT NULL, premelimary_meeting DOUBLE PRECISION DEFAULT NULL, first_pedagogical_meeting DOUBLE PRECISION DEFAULT NULL, second_pedagogical_meeting DOUBLE PRECISION DEFAULT NULL, INDEX IDX_1DAAE648A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE perfectionnement (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, inscription_fee DOUBLE PRECISION NOT NULL, driving DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_BFE4ED2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(20) NOT NULL, last_name VARCHAR(30) DEFAULT NULL, image LONGTEXT DEFAULT NULL, fonction VARCHAR(40) NOT NULL, description LONGTEXT DEFAULT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actuality ADD CONSTRAINT FK_4093DDD8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE gateway ADD CONSTRAINT FK_14FEDD7FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE licence ADD CONSTRAINT FK_1DAAE648A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE perfectionnement ADD CONSTRAINT FK_BFE4ED2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actuality DROP FOREIGN KEY FK_4093DDD8A76ED395');
        $this->addSql('ALTER TABLE gateway DROP FOREIGN KEY FK_14FEDD7FA76ED395');
        $this->addSql('ALTER TABLE licence DROP FOREIGN KEY FK_1DAAE648A76ED395');
        $this->addSql('ALTER TABLE perfectionnement DROP FOREIGN KEY FK_BFE4ED2A76ED395');
        $this->addSql('DROP TABLE actuality');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE gateway');
        $this->addSql('DROP TABLE licence');
        $this->addSql('DROP TABLE perfectionnement');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
