<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200829181011 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, quincaillerie_id INT NOT NULL, libelle VARCHAR(45) NOT NULL, prixencours INT NOT NULL, unite VARCHAR(45) NOT NULL, codearticle VARCHAR(45) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_23A0E663E397524 (quincaillerie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, codecategorie VARCHAR(45) NOT NULL, libelle VARCHAR(45) NOT NULL, INDEX IDX_497DD634BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, codegroupe VARCHAR(45) NOT NULL, libellegroupe VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quincaillerie (id INT AUTO_INCREMENT NOT NULL, libellequic VARCHAR(100) NOT NULL, codequinc VARCHAR(45) NOT NULL, email VARCHAR(55) NOT NULL, tel VARCHAR(20) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(45) NOT NULL, region VARCHAR(45) NOT NULL, longe VARCHAR(45) NOT NULL, lat VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, quincaillerie_id_id INT NOT NULL, groupe_id_id INT NOT NULL, user VARCHAR(45) NOT NULL, email VARCHAR(100) NOT NULL, tel VARCHAR(25) NOT NULL, INDEX IDX_8D93D64954482E89 (quincaillerie_id_id), INDEX IDX_8D93D6492AE95007 (groupe_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E663E397524 FOREIGN KEY (quincaillerie_id) REFERENCES quincaillerie (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64954482E89 FOREIGN KEY (quincaillerie_id_id) REFERENCES quincaillerie (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492AE95007 FOREIGN KEY (groupe_id_id) REFERENCES groupe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634BCF5E72D');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492AE95007');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E663E397524');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64954482E89');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE quincaillerie');
        $this->addSql('DROP TABLE user');
    }
}
