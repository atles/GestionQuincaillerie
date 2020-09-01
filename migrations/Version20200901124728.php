<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200901124728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, typeclient VARCHAR(45) NOT NULL, prenom VARCHAR(45) DEFAULT NULL, nom VARCHAR(45) DEFAULT NULL, adresse VARCHAR(45) DEFAULT NULL, email VARCHAR(45) DEFAULT NULL, tel VARCHAR(45) DEFAULT NULL, acompte INT NOT NULL, photo VARCHAR(45) DEFAULT NULL, profession VARCHAR(45) DEFAULT NULL, solde INT NOT NULL, INDEX IDX_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, datecommande DATETIME NOT NULL, designation VARCHAR(255) NOT NULL, montant INT NOT NULL, numfacture VARCHAR(45) NOT NULL, description VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lignecommande (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, article_id INT NOT NULL, pu VARCHAR(45) DEFAULT NULL, qte VARCHAR(45) DEFAULT NULL, unit VARCHAR(45) NOT NULL, INDEX IDX_853B793982EA2E54 (commande_id), INDEX IDX_853B79397294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, typeoperation_id INT NOT NULL, client_id INT NOT NULL, lignecommande_id INT DEFAULT NULL, INDEX IDX_1981A66D510850EC (typeoperation_id), INDEX IDX_1981A66D19EB6921 (client_id), INDEX IDX_1981A66D20D3031 (lignecommande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typeoperation (id INT AUTO_INCREMENT NOT NULL, typeoperation VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lignecommande ADD CONSTRAINT FK_853B793982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE lignecommande ADD CONSTRAINT FK_853B79397294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D510850EC FOREIGN KEY (typeoperation_id) REFERENCES typeoperation (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D20D3031 FOREIGN KEY (lignecommande_id) REFERENCES lignecommande (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D19EB6921');
        $this->addSql('ALTER TABLE lignecommande DROP FOREIGN KEY FK_853B793982EA2E54');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D20D3031');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D510850EC');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE lignecommande');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE typeoperation');
    }
}
