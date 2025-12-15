<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251215145812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE approvisionnement (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(50) NOT NULL, datetime_immutable VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, reference VARCHAR(50) NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, contact VARCHAR(255) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE ligne_approvisionnement (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, prix_achat DOUBLE PRECISION NOT NULL, approvisionnement_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_A362417AE741A98 (approvisionnement_id), INDEX IDX_A3624177294869C (article_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE ligne_approvisionnement ADD CONSTRAINT FK_A362417AE741A98 FOREIGN KEY (approvisionnement_id) REFERENCES approvisionnement (id)');
        $this->addSql('ALTER TABLE ligne_approvisionnement ADD CONSTRAINT FK_A3624177294869C FOREIGN KEY (article_id) REFERENCES article (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ligne_approvisionnement DROP FOREIGN KEY FK_A362417AE741A98');
        $this->addSql('ALTER TABLE ligne_approvisionnement DROP FOREIGN KEY FK_A3624177294869C');
        $this->addSql('DROP TABLE approvisionnement');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE ligne_approvisionnement');
    }
}
