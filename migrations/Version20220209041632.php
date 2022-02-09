<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220209041632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sample_image ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sample_image ADD CONSTRAINT FK_CDEC0F50727ACA70 FOREIGN KEY (parent_id) REFERENCES sample_image (id)');
        $this->addSql('CREATE INDEX IDX_CDEC0F50727ACA70 ON sample_image (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application CHANGE experience experience LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE model_height model_height VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE model_weight model_weight VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE model_shoe_size model_shoe_size VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE model_clothing_size model_clothing_size VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE model_hair_color model_hair_color VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE model_eye_color model_eye_color VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE application_image CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE menu CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE slug slug VARCHAR(128) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE menu_entry CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE slug slug VARCHAR(128) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE route route VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon icon VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE sample_comment CHANGE content content LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE sample_image DROP FOREIGN KEY FK_CDEC0F50727ACA70');
        $this->addSql('DROP INDEX IDX_CDEC0F50727ACA70 ON sample_image');
        $this->addSql('ALTER TABLE sample_image DROP parent_id, CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tag CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE slug slug VARCHAR(128) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE locale locale VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE privat_name_first_name privat_name_first_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE privat_name_last_name privat_name_last_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE company_name_line1 company_name_line1 VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE company_name_line2 company_name_line2 VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE address_street address_street VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE address_postal_code address_postal_code VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE address_city address_city VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE address_country address_country VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
