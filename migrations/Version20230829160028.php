<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230829160028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE contact_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE equipment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hourly_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE testimony_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE contact (id INT NOT NULL, name VARCHAR(100) NOT NULL, first_name VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, phone INT NOT NULL, message TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN contact.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE equipment (id INT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE hourly (id INT NOT NULL, day VARCHAR(11) NOT NULL, opening_time VARCHAR(50) NOT NULL, closed_time VARCHAR(50) NOT NULL, closed BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN hourly.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN hourly.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_equipment (product_id INT NOT NULL, equipment_id INT NOT NULL, PRIMARY KEY(product_id, equipment_id))');
        $this->addSql('CREATE INDEX IDX_BD98630E4584665A ON product_equipment (product_id)');
        $this->addSql('CREATE INDEX IDX_BD98630E517FE9FE ON product_equipment (equipment_id)');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, price INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN service.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN service.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE testimony (id INT NOT NULL, name VARCHAR(100) NOT NULL, commentaire TEXT NOT NULL, note INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE product_equipment ADD CONSTRAINT FK_BD98630E4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_equipment ADD CONSTRAINT FK_BD98630E517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE contact_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE equipment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hourly_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE testimony_id_seq CASCADE');
        $this->addSql('ALTER TABLE product_equipment DROP CONSTRAINT FK_BD98630E4584665A');
        $this->addSql('ALTER TABLE product_equipment DROP CONSTRAINT FK_BD98630E517FE9FE');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE hourly');
        $this->addSql('DROP TABLE product_equipment');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE testimony');
    }
}
