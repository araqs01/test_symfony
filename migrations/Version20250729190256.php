<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250729190256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE estimated_products (id INT AUTO_INCREMENT NOT NULL, estimate_id INT NOT NULL, service_id INT NOT NULL, price NUMERIC(10, 2) NOT NULL, quantity INT NOT NULL, INDEX IDX_21ED8DD985F23082 (estimate_id), INDEX IDX_21ED8DD9ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estimates (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE estimated_products ADD CONSTRAINT FK_21ED8DD985F23082 FOREIGN KEY (estimate_id) REFERENCES estimates (id)');
        $this->addSql('ALTER TABLE estimated_products ADD CONSTRAINT FK_21ED8DD9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE estimated_products DROP FOREIGN KEY FK_21ED8DD985F23082');
        $this->addSql('ALTER TABLE estimated_products DROP FOREIGN KEY FK_21ED8DD9ED5CA9E6');
        $this->addSql('DROP TABLE estimated_products');
        $this->addSql('DROP TABLE estimates');
        $this->addSql('DROP TABLE services');
    }
}
