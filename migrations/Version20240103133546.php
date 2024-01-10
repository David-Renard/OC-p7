<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240103133546 extends AbstractMigration
{


    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // This up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_reseller DROP CONSTRAINT fk_34c41bb69395c3f3');
        $this->addSql('ALTER TABLE customer_reseller DROP CONSTRAINT fk_34c41bb691e6a19d');
        $this->addSql('DROP TABLE customer_reseller');
        $this->addSql('ALTER TABLE customer ADD reseller_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E0991E6A19D FOREIGN KEY (reseller_id) REFERENCES reseller (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_81398E0991E6A19D ON customer (reseller_id)');
    }

    public function down(Schema $schema): void
    {
        // This down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE customer_reseller (customer_id INT NOT NULL, reseller_id INT NOT NULL, PRIMARY KEY(customer_id, reseller_id))');
        $this->addSql('CREATE INDEX idx_34c41bb691e6a19d ON customer_reseller (reseller_id)');
        $this->addSql('CREATE INDEX idx_34c41bb69395c3f3 ON customer_reseller (customer_id)');
        $this->addSql('ALTER TABLE customer_reseller ADD CONSTRAINT fk_34c41bb69395c3f3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer_reseller ADD CONSTRAINT fk_34c41bb691e6a19d FOREIGN KEY (reseller_id) REFERENCES reseller (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE customer DROP CONSTRAINT FK_81398E0991E6A19D');
        $this->addSql('DROP INDEX IDX_81398E0991E6A19D');
        $this->addSql('ALTER TABLE customer DROP reseller_id');
    }
}
