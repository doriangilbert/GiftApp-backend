<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607152220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cadeau (id INT AUTO_INCREMENT NOT NULL, demandeur_id INT DEFAULT NULL, acheteur_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, lien_image VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, lien_site_web VARCHAR(255) DEFAULT NULL, INDEX IDX_3D21346095A6EE59 (demandeur_id), INDEX IDX_3D21346096A7BB5F (acheteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, possede_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_4B98C21C835AB29 (possede_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_utilisateur (groupe_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_92C1107D7A45358C (groupe_id), INDEX IDX_92C1107DFB88E14F (utilisateur_id), PRIMARY KEY(groupe_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste (id INT AUTO_INCREMENT NOT NULL, concerne_id INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, INDEX IDX_FCF22AF46406FEF1 (concerne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_cadeau (liste_id INT NOT NULL, cadeau_id INT NOT NULL, INDEX IDX_C50415BE85441D8 (liste_id), INDEX IDX_C50415BD9D5ED84 (cadeau_id), PRIMARY KEY(liste_id, cadeau_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_groupe (liste_id INT NOT NULL, groupe_id INT NOT NULL, INDEX IDX_35C8F91AE85441D8 (liste_id), INDEX IDX_35C8F91A7A45358C (groupe_id), PRIMARY KEY(liste_id, groupe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cadeau ADD CONSTRAINT FK_3D21346095A6EE59 FOREIGN KEY (demandeur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE cadeau ADD CONSTRAINT FK_3D21346096A7BB5F FOREIGN KEY (acheteur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21C835AB29 FOREIGN KEY (possede_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE groupe_utilisateur ADD CONSTRAINT FK_92C1107D7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_utilisateur ADD CONSTRAINT FK_92C1107DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF46406FEF1 FOREIGN KEY (concerne_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE liste_cadeau ADD CONSTRAINT FK_C50415BE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_cadeau ADD CONSTRAINT FK_C50415BD9D5ED84 FOREIGN KEY (cadeau_id) REFERENCES cadeau (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_groupe ADD CONSTRAINT FK_35C8F91AE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_groupe ADD CONSTRAINT FK_35C8F91A7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_cadeau DROP FOREIGN KEY FK_C50415BD9D5ED84');
        $this->addSql('ALTER TABLE groupe_utilisateur DROP FOREIGN KEY FK_92C1107D7A45358C');
        $this->addSql('ALTER TABLE liste_groupe DROP FOREIGN KEY FK_35C8F91A7A45358C');
        $this->addSql('ALTER TABLE liste_cadeau DROP FOREIGN KEY FK_C50415BE85441D8');
        $this->addSql('ALTER TABLE liste_groupe DROP FOREIGN KEY FK_35C8F91AE85441D8');
        $this->addSql('ALTER TABLE cadeau DROP FOREIGN KEY FK_3D21346095A6EE59');
        $this->addSql('ALTER TABLE cadeau DROP FOREIGN KEY FK_3D21346096A7BB5F');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21C835AB29');
        $this->addSql('ALTER TABLE groupe_utilisateur DROP FOREIGN KEY FK_92C1107DFB88E14F');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF46406FEF1');
        $this->addSql('DROP TABLE cadeau');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE groupe_utilisateur');
        $this->addSql('DROP TABLE liste');
        $this->addSql('DROP TABLE liste_cadeau');
        $this->addSql('DROP TABLE liste_groupe');
        $this->addSql('DROP TABLE utilisateur');
    }
}
