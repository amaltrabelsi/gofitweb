<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220430005114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualite CHANGE Path_Image Path_Image VARCHAR(450) DEFAULT \'\'\'NULL\'\'\'');
        $this->addSql('ALTER TABLE business CHANGE Tel_Fix Tel_Fix VARCHAR(10) DEFAULT \'\'\'NULL\'\'\'');
        $this->addSql('ALTER TABLE produit CHANGE Path_Image Path_Image VARCHAR(150) DEFAULT \'\'\'NULL\'\'\'');
        $this->addSql('ALTER TABLE utilisateur ADD num INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualite CHANGE Path_Image Path_Image VARCHAR(450) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE business CHANGE Tel_Fix Tel_Fix VARCHAR(10) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE produit CHANGE Path_Image Path_Image VARCHAR(150) DEFAULT \'NULL\'');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP num');
    }
}
