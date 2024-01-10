<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231219143649 extends AbstractMigration
{


    public function getDescription(): string
    {
        return '';

    }

    public function up(Schema $schema): void
    {
        // This up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE customer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reseller_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE smartphone_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE customer (id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN customer.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE customer_reseller (customer_id INT NOT NULL, reseller_id INT NOT NULL, PRIMARY KEY(customer_id, reseller_id))');
        $this->addSql('CREATE INDEX IDX_34C41BB69395C3F3 ON customer_reseller (customer_id)');
        $this->addSql('CREATE INDEX IDX_34C41BB691E6A19D ON customer_reseller (reseller_id)');
        $this->addSql('CREATE TABLE reseller (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, company_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_18015899E7927C74 ON reseller (email)');
        $this->addSql('CREATE TABLE smartphone (id INT NOT NULL, name VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, price INT NOT NULL, description TEXT DEFAULT NULL, processor VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE customer_reseller ADD CONSTRAINT FK_34C41BB69395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_reseller ADD CONSTRAINT FK_34C41BB691E6A19D FOREIGN KEY (reseller_id) REFERENCES reseller (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

    }

    public function down(Schema $schema): void
    {
        // This down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE customer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reseller_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE smartphone_id_seq CASCADE');
        $this->addSql('ALTER TABLE customer_reseller DROP CONSTRAINT FK_34C41BB69395C3F3');
        $this->addSql('ALTER TABLE customer_reseller DROP CONSTRAINT FK_34C41BB691E6A19D');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customer_reseller');
        $this->addSql('DROP TABLE reseller');
        $this->addSql('DROP TABLE smartphone');

    }
}
