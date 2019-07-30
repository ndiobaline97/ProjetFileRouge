<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726125949 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE superadmin (id INT AUTO_INCREMENT NOT NULL, nom_entreprise VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE systeme');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE partenaire ADD statut VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD statut VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBC2FC59CD3 FOREIGN KEY (iddepot_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_47948BBC2FC59CD3 ON depot (iddepot_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE systeme (id INT AUTO_INCREMENT NOT NULL, idsysteme_id INT NOT NULL, INDEX IDX_95796DE3F9C66A14 (idsysteme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, roles JSON NOT NULL, password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_1D1C63B3AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE systeme ADD CONSTRAINT FK_95796DE3F9C66A14 FOREIGN KEY (idsysteme_id) REFERENCES partenaire (id)');
        $this->addSql('DROP TABLE superadmin');
        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBC2FC59CD3');
        $this->addSql('DROP INDEX IDX_47948BBC2FC59CD3 ON depot');
        $this->addSql('ALTER TABLE partenaire DROP statut');
        $this->addSql('ALTER TABLE user DROP statut');
    }
}
