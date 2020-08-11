<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811083913 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor_grupe (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, adres VARCHAR(255) NOT NULL, phone INT NOT NULL, UNIQUE INDEX UNIQ_485F9959A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE business (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, nip INT NOT NULL, adres VARCHAR(255) NOT NULL, phone INT NOT NULL, UNIQUE INDEX UNIQ_8D36E38A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate_profil (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, growth INT NOT NULL, physique VARCHAR(255) NOT NULL, hair_length VARCHAR(255) NOT NULL, hair_color VARCHAR(255) NOT NULL, eye_color VARCHAR(255) NOT NULL, age INT NOT NULL, UNIQUE INDEX UNIQ_52E5EC4BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, nip INT DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', token VARCHAR(255) DEFAULT NULL, token_expire DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, description VARCHAR(255) NOT NULL, photo_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE send_offer_business (id INT AUTO_INCREMENT NOT NULL, business_id INT NOT NULL, candidate_id INT DEFAULT NULL, send_data DATETIME NOT NULL, is_send TINYINT(1) NOT NULL, INDEX IDX_A714A9EDA89DB457 (business_id), INDEX IDX_A714A9ED91BD8781 (candidate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE send_offer_grupe (id INT AUTO_INCREMENT NOT NULL, grupe_id INT NOT NULL, candidat_id INT NOT NULL, send_date DATETIME NOT NULL, is_send TINYINT(1) NOT NULL, INDEX IDX_283EA602F33ED067 (grupe_id), INDEX IDX_283EA6028D0EB82 (candidat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, token VARCHAR(255) DEFAULT NULL, token_expire DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, photo VARCHAR(255) DEFAULT NULL, login VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actor_grupe ADD CONSTRAINT FK_485F9959A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE business ADD CONSTRAINT FK_8D36E38A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE candidate_profil ADD CONSTRAINT FK_52E5EC4BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE send_offer_business ADD CONSTRAINT FK_A714A9EDA89DB457 FOREIGN KEY (business_id) REFERENCES business (id)');
        $this->addSql('ALTER TABLE send_offer_business ADD CONSTRAINT FK_A714A9ED91BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate_profil (id)');
        $this->addSql('ALTER TABLE send_offer_grupe ADD CONSTRAINT FK_283EA602F33ED067 FOREIGN KEY (grupe_id) REFERENCES actor_grupe (id)');
        $this->addSql('ALTER TABLE send_offer_grupe ADD CONSTRAINT FK_283EA6028D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidate_profil (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE send_offer_grupe DROP FOREIGN KEY FK_283EA602F33ED067');
        $this->addSql('ALTER TABLE send_offer_business DROP FOREIGN KEY FK_A714A9EDA89DB457');
        $this->addSql('ALTER TABLE send_offer_business DROP FOREIGN KEY FK_A714A9ED91BD8781');
        $this->addSql('ALTER TABLE send_offer_grupe DROP FOREIGN KEY FK_283EA6028D0EB82');
        $this->addSql('ALTER TABLE actor_grupe DROP FOREIGN KEY FK_485F9959A76ED395');
        $this->addSql('ALTER TABLE business DROP FOREIGN KEY FK_8D36E38A76ED395');
        $this->addSql('ALTER TABLE candidate_profil DROP FOREIGN KEY FK_52E5EC4BA76ED395');
        $this->addSql('DROP TABLE actor_grupe');
        $this->addSql('DROP TABLE business');
        $this->addSql('DROP TABLE candidate_profil');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE send_offer_business');
        $this->addSql('DROP TABLE send_offer_grupe');
        $this->addSql('DROP TABLE user');
    }
}
