<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230112091905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, zip_code INT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, vehicle_id_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, return_localisation VARCHAR(255) NOT NULL, start_condition VARCHAR(255) NOT NULL, return_condition VARCHAR(255) DEFAULT NULL, licence_number INT DEFAULT NULL, return_km DOUBLE PRECISION DEFAULT NULL, start_km DOUBLE PRECISION DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3BAE0AA79D86650F (user_id_id), INDEX IDX_3BAE0AA71DEB1EBB (vehicle_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, address LONGTEXT DEFAULT NULL, zip_code INT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, roles VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, company_id_id INT DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, model VARCHAR(255) DEFAULT NULL, register_plate VARCHAR(255) DEFAULT NULL, number_of_doors INT DEFAULT NULL, number_of_seats INT DEFAULT NULL, energy VARCHAR(255) DEFAULT NULL, volume DOUBLE PRECISION DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, transmission VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, licence_required VARCHAR(255) DEFAULT NULL, is_on_park TINYINT(1) DEFAULT NULL, localisation VARCHAR(255) DEFAULT NULL, is_available TINYINT(1) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX IDX_1B80E48638B53C32 (company_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA79D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA71DEB1EBB FOREIGN KEY (vehicle_id_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E48638B53C32 FOREIGN KEY (company_id_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA79D86650F');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA71DEB1EBB');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E48638B53C32');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
