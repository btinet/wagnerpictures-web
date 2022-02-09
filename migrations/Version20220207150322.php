<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220207150322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, is_complete TINYINT(1) DEFAULT NULL, experience LONGTEXT DEFAULT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, model_height VARCHAR(255) DEFAULT NULL, model_weight VARCHAR(255) DEFAULT NULL, model_shoe_size VARCHAR(255) DEFAULT NULL, model_clothing_size VARCHAR(255) DEFAULT NULL, model_hair_color VARCHAR(255) DEFAULT NULL, model_eye_color VARCHAR(255) DEFAULT NULL, INDEX IDX_A45BDDC1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE application_image (id INT AUTO_INCREMENT NOT NULL, application_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, INDEX IDX_26A9E3253E030ACD (application_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_7D053A93989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_entry (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, route VARCHAR(255) NOT NULL, icon VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_BA8DBE17989D9B62 (slug), INDEX IDX_BA8DBE17C54C8C93 (type_id), INDEX IDX_BA8DBE17727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sample_comment (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, user_id INT NOT NULL, sample_image_id INT NOT NULL, content LONGTEXT NOT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, INDEX IDX_843E9FFA727ACA70 (parent_id), INDEX IDX_843E9FFAA76ED395 (user_id), INDEX IDX_843E9FFA24D959D1 (sample_image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sample_image (id INT AUTO_INCREMENT NOT NULL, tags_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, is_published INT DEFAULT NULL, image VARCHAR(255) NOT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, INDEX IDX_CDEC0F508D7B4FB4 (tags_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sample_like (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sample_like_sample_image (sample_like_id INT NOT NULL, sample_image_id INT NOT NULL, INDEX IDX_9DE13AC395D137A4 (sample_like_id), INDEX IDX_9DE13AC324D959D1 (sample_image_id), PRIMARY KEY(sample_like_id, sample_image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sample_like_user (sample_like_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_962889EC95D137A4 (sample_like_id), INDEX IDX_962889ECA76ED395 (user_id), PRIMARY KEY(sample_like_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_389B783989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, locale VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, privat_name_first_name VARCHAR(255) NOT NULL, privat_name_last_name VARCHAR(255) NOT NULL, company_name_line1 VARCHAR(255) DEFAULT NULL, company_name_line2 VARCHAR(255) DEFAULT NULL, address_street VARCHAR(255) NOT NULL, address_postal_code VARCHAR(255) NOT NULL, address_city VARCHAR(255) NOT NULL, address_country VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE application_image ADD CONSTRAINT FK_26A9E3253E030ACD FOREIGN KEY (application_id) REFERENCES application (id)');
        $this->addSql('ALTER TABLE menu_entry ADD CONSTRAINT FK_BA8DBE17C54C8C93 FOREIGN KEY (type_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_entry ADD CONSTRAINT FK_BA8DBE17727ACA70 FOREIGN KEY (parent_id) REFERENCES menu_entry (id)');
        $this->addSql('ALTER TABLE sample_comment ADD CONSTRAINT FK_843E9FFA727ACA70 FOREIGN KEY (parent_id) REFERENCES sample_comment (id)');
        $this->addSql('ALTER TABLE sample_comment ADD CONSTRAINT FK_843E9FFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sample_comment ADD CONSTRAINT FK_843E9FFA24D959D1 FOREIGN KEY (sample_image_id) REFERENCES sample_image (id)');
        $this->addSql('ALTER TABLE sample_image ADD CONSTRAINT FK_CDEC0F508D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tag (id)');
        $this->addSql('ALTER TABLE sample_like_sample_image ADD CONSTRAINT FK_9DE13AC395D137A4 FOREIGN KEY (sample_like_id) REFERENCES sample_like (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sample_like_sample_image ADD CONSTRAINT FK_9DE13AC324D959D1 FOREIGN KEY (sample_image_id) REFERENCES sample_image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sample_like_user ADD CONSTRAINT FK_962889EC95D137A4 FOREIGN KEY (sample_like_id) REFERENCES sample_like (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sample_like_user ADD CONSTRAINT FK_962889ECA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application_image DROP FOREIGN KEY FK_26A9E3253E030ACD');
        $this->addSql('ALTER TABLE menu_entry DROP FOREIGN KEY FK_BA8DBE17C54C8C93');
        $this->addSql('ALTER TABLE menu_entry DROP FOREIGN KEY FK_BA8DBE17727ACA70');
        $this->addSql('ALTER TABLE sample_comment DROP FOREIGN KEY FK_843E9FFA727ACA70');
        $this->addSql('ALTER TABLE sample_comment DROP FOREIGN KEY FK_843E9FFA24D959D1');
        $this->addSql('ALTER TABLE sample_like_sample_image DROP FOREIGN KEY FK_9DE13AC324D959D1');
        $this->addSql('ALTER TABLE sample_like_sample_image DROP FOREIGN KEY FK_9DE13AC395D137A4');
        $this->addSql('ALTER TABLE sample_like_user DROP FOREIGN KEY FK_962889EC95D137A4');
        $this->addSql('ALTER TABLE sample_image DROP FOREIGN KEY FK_CDEC0F508D7B4FB4');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1A76ED395');
        $this->addSql('ALTER TABLE sample_comment DROP FOREIGN KEY FK_843E9FFAA76ED395');
        $this->addSql('ALTER TABLE sample_like_user DROP FOREIGN KEY FK_962889ECA76ED395');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE application_image');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_entry');
        $this->addSql('DROP TABLE sample_comment');
        $this->addSql('DROP TABLE sample_image');
        $this->addSql('DROP TABLE sample_like');
        $this->addSql('DROP TABLE sample_like_sample_image');
        $this->addSql('DROP TABLE sample_like_user');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE user');
    }
}
