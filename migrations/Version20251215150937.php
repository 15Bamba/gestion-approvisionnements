<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251215150937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approvisionnement ADD date_creation DATETIME NOT NULL, DROP datetime_immutable');
        $this->addSql('ALTER TABLE ligne_approvisionnement ADD CONSTRAINT FK_A362417AE741A98 FOREIGN KEY (approvisionnement_id) REFERENCES approvisionnement (id)');
        $this->addSql('ALTER TABLE ligne_approvisionnement ADD CONSTRAINT FK_A3624177294869C FOREIGN KEY (article_id) REFERENCES article (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approvisionnement ADD datetime_immutable VARCHAR(255) NOT NULL, DROP date_creation');
        $this->addSql('ALTER TABLE ligne_approvisionnement DROP FOREIGN KEY FK_A362417AE741A98');
        $this->addSql('ALTER TABLE ligne_approvisionnement DROP FOREIGN KEY FK_A3624177294869C');
    }
}
