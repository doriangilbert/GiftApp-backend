<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617111913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gift (id INT AUTO_INCREMENT NOT NULL, wished_by_id INT DEFAULT NULL, offered_by_id INT DEFAULT NULL, included_by_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, INDEX IDX_A47C990D8CB4B09C (wished_by_id), INDEX IDX_A47C990DC68D530F (offered_by_id), INDEX IDX_A47C990D65275021 (included_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, ownered_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_6DC044C5EBF313D9 (ownered_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_of_gift (id INT AUTO_INCREMENT NOT NULL, concerned_by_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, INDEX IDX_DD0BCC33C471E14F (concerned_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_8F02BF9DA76ED395 (user_id), INDEX IDX_8F02BF9DFE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_user (user_source INT NOT NULL, user_target INT NOT NULL, INDEX IDX_F7129A803AD8644E (user_source), INDEX IDX_F7129A80233D34C1 (user_target), PRIMARY KEY(user_source, user_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gift ADD CONSTRAINT FK_A47C990D8CB4B09C FOREIGN KEY (wished_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE gift ADD CONSTRAINT FK_A47C990DC68D530F FOREIGN KEY (offered_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE gift ADD CONSTRAINT FK_A47C990D65275021 FOREIGN KEY (included_by_id) REFERENCES list_of_gift (id)');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5EBF313D9 FOREIGN KEY (ownered_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE list_of_gift ADD CONSTRAINT FK_DD0BCC33C471E14F FOREIGN KEY (concerned_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DFE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user ADD CONSTRAINT FK_F7129A803AD8644E FOREIGN KEY (user_source) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user ADD CONSTRAINT FK_F7129A80233D34C1 FOREIGN KEY (user_target) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_group DROP FOREIGN KEY FK_8F02BF9DFE54D947');
        $this->addSql('ALTER TABLE gift DROP FOREIGN KEY FK_A47C990D65275021');
        $this->addSql('ALTER TABLE gift DROP FOREIGN KEY FK_A47C990D8CB4B09C');
        $this->addSql('ALTER TABLE gift DROP FOREIGN KEY FK_A47C990DC68D530F');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C5EBF313D9');
        $this->addSql('ALTER TABLE list_of_gift DROP FOREIGN KEY FK_DD0BCC33C471E14F');
        $this->addSql('ALTER TABLE user_group DROP FOREIGN KEY FK_8F02BF9DA76ED395');
        $this->addSql('ALTER TABLE user_user DROP FOREIGN KEY FK_F7129A803AD8644E');
        $this->addSql('ALTER TABLE user_user DROP FOREIGN KEY FK_F7129A80233D34C1');
        $this->addSql('DROP TABLE gift');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE list_of_gift');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_group');
        $this->addSql('DROP TABLE user_user');
    }
}
