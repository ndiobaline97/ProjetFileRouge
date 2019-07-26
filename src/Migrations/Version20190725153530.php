<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190725153530 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBC2FC59CD3');
        $this->addSql('DROP INDEX IDX_47948BBC2FC59CD3 ON depot');
        $this->addSql('ALTER TABLE depot CHANGE idcompte_id iddepot_id INT NOT NULL');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBC2FC59CD3 FOREIGN KEY (iddepot_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_47948BBC2FC59CD3 ON depot (iddepot_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBC2FC59CD3');
        $this->addSql('DROP INDEX IDX_47948BBC2FC59CD3 ON depot');
        $this->addSql('ALTER TABLE depot CHANGE iddepot_id idcompte_id INT NOT NULL');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBC2FC59CD3 FOREIGN KEY (idcompte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_47948BBC2FC59CD3 ON depot (idcompte_id)');
    }
}
