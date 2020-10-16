<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201012094625 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, date DATE NOT NULL, frais_inscription INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adherent_competition (adherent_id INT NOT NULL, competition_id INT NOT NULL, INDEX IDX_3495E35F25F06C53 (adherent_id), INDEX IDX_3495E35F7B39D312 (competition_id), PRIMARY KEY(adherent_id, competition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adherent_competition ADD CONSTRAINT FK_3495E35F25F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adherent_competition ADD CONSTRAINT FK_3495E35F7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adherent_competition DROP FOREIGN KEY FK_3495E35F7B39D312');
        $this->addSql('DROP TABLE adherent_competition');
        $this->addSql('DROP TABLE competition');
    }
}
