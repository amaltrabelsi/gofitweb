<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220424041928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY Fk_terrainRec_Id');
        $this->addSql('ALTER TABLE reclamation CHANGE Fkutilisateur Fkutilisateur INT DEFAULT NULL');
        $this->addSql('DROP INDEX fk_terrainrec_id ON reclamation');
        $this->addSql('CREATE INDEX FkterrainRecId ON reclamation (FkterrainRecId)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT Fk_terrainRec_Id FOREIGN KEY (FkterrainRecId) REFERENCES terrain (Terrain_Id)');
        $this->addSql('ALTER TABLE terrain ADD image VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404F493E6AD');
        $this->addSql('ALTER TABLE reclamation CHANGE Fkutilisateur Fkutilisateur INT NOT NULL');
        $this->addSql('DROP INDEX fkterrainrecid ON reclamation');
        $this->addSql('CREATE INDEX Fk_terrainRec_Id ON reclamation (FkterrainRecId)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404F493E6AD FOREIGN KEY (FkterrainRecId) REFERENCES terrain (Terrain_Id)');
        $this->addSql('ALTER TABLE terrain DROP image');
    }
}
