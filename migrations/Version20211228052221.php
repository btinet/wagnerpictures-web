<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228052221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sample_comment (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, user_id INT NOT NULL, sample_image_id INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_843E9FFA727ACA70 (parent_id), INDEX IDX_843E9FFAA76ED395 (user_id), INDEX IDX_843E9FFA24D959D1 (sample_image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sample_comment ADD CONSTRAINT FK_843E9FFA727ACA70 FOREIGN KEY (parent_id) REFERENCES sample_comment (id)');
        $this->addSql('ALTER TABLE sample_comment ADD CONSTRAINT FK_843E9FFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sample_comment ADD CONSTRAINT FK_843E9FFA24D959D1 FOREIGN KEY (sample_image_id) REFERENCES sample_image (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sample_comment DROP FOREIGN KEY FK_843E9FFA727ACA70');
        $this->addSql('DROP TABLE sample_comment');
    }
}
