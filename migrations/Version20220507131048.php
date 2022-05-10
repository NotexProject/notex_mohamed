<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220507131048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compt (idcompt INT AUTO_INCREMENT NOT NULL, fullname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, birth DATETIME DEFAULT NULL, country VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', is_verified TINYINT(1) NOT NULL, facebook_access_token VARCHAR(255) DEFAULT NULL, github_id VARCHAR(255) DEFAULT NULL, github_access_token VARCHAR(255) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, PRIMARY KEY(idcompt)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (idoffre INT AUTO_INCREMENT NOT NULL, nomoffre VARCHAR(255) NOT NULL, datedebut DATE NOT NULL, datefin DATE NOT NULL, description TEXT NOT NULL, imgsrc VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, typeoffre VARCHAR(255) NOT NULL, cincreateuroffre INT NOT NULL, INDEX cincreateuroffre (cincreateuroffre), PRIMARY KEY(idoffre)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (idreclamation INT AUTO_INCREMENT NOT NULL, offreareclamer INT DEFAULT NULL, cinreclameur INT DEFAULT NULL, typereclamation VARCHAR(255) NOT NULL, datereclamation DATE NOT NULL, descriptionrecla TEXT NOT NULL, comuniquer TEXT NOT NULL, etat VARCHAR(255) NOT NULL, INDEX offreareclamer (offreareclamer), INDEX cinreclameur (cinreclameur), PRIMARY KEY(idreclamation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404385E6A62 FOREIGN KEY (offreareclamer) REFERENCES offre (idoffre)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE6064048CD9DD77 FOREIGN KEY (cinreclameur) REFERENCES compt (idcompt)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE6064048CD9DD77');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404385E6A62');
        $this->addSql('DROP TABLE compt');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE reclamation');
    }
}
