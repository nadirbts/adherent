<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201012084749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adherent ADD club_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adherent ADD CONSTRAINT FK_90D3F06061190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_90D3F06061190A32 ON adherent (club_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adherent DROP FOREIGN KEY FK_90D3F06061190A32');
        $this->addSql('DROP INDEX IDX_90D3F06061190A32 ON adherent');
        $this->addSql('ALTER TABLE adherent DROP club_id');
    }
}
