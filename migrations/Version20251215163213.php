<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251215163213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approvisionnement ADD fournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE approvisionnement ADD CONSTRAINT FK_516C3FAA670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_516C3FAA670C757F ON approvisionnement (fournisseur_id)');
        $this->addSql('ALTER TABLE ligne_approvisionnement ADD fournisseur_id INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_approvisionnement ADD CONSTRAINT FK_A362417AE741A98 FOREIGN KEY (approvisionnement_id) REFERENCES approvisionnement (id)');
        $this->addSql('ALTER TABLE ligne_approvisionnement ADD CONSTRAINT FK_A3624177294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE ligne_approvisionnement ADD CONSTRAINT FK_A362417670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_A362417670C757F ON ligne_approvisionnement (fournisseur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approvisionnement DROP FOREIGN KEY FK_516C3FAA670C757F');
        $this->addSql('DROP INDEX IDX_516C3FAA670C757F ON approvisionnement');
        $this->addSql('ALTER TABLE approvisionnement DROP fournisseur_id');
        $this->addSql('ALTER TABLE ligne_approvisionnement DROP FOREIGN KEY FK_A362417AE741A98');
        $this->addSql('ALTER TABLE ligne_approvisionnement DROP FOREIGN KEY FK_A3624177294869C');
        $this->addSql('ALTER TABLE ligne_approvisionnement DROP FOREIGN KEY FK_A362417670C757F');
        $this->addSql('DROP INDEX IDX_A362417670C757F ON ligne_approvisionnement');
        $this->addSql('ALTER TABLE ligne_approvisionnement DROP fournisseur_id');
    }
}
