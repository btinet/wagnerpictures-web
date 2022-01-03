<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211223065944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sample_like (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sample_like_sample_image (sample_like_id INT NOT NULL, sample_image_id INT NOT NULL, INDEX IDX_9DE13AC395D137A4 (sample_like_id), INDEX IDX_9DE13AC324D959D1 (sample_image_id), PRIMARY KEY(sample_like_id, sample_image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sample_like_user (sample_like_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_962889EC95D137A4 (sample_like_id), INDEX IDX_962889ECA76ED395 (user_id), PRIMARY KEY(sample_like_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sample_like_sample_image ADD CONSTRAINT FK_9DE13AC395D137A4 FOREIGN KEY (sample_like_id) REFERENCES sample_like (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sample_like_sample_image ADD CONSTRAINT FK_9DE13AC324D959D1 FOREIGN KEY (sample_image_id) REFERENCES sample_image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sample_like_user ADD CONSTRAINT FK_962889EC95D137A4 FOREIGN KEY (sample_like_id) REFERENCES sample_like (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sample_like_user ADD CONSTRAINT FK_962889ECA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sample_like_sample_image DROP FOREIGN KEY FK_9DE13AC395D137A4');
        $this->addSql('ALTER TABLE sample_like_user DROP FOREIGN KEY FK_962889EC95D137A4');
        $this->addSql('DROP TABLE sample_like');
        $this->addSql('DROP TABLE sample_like_sample_image');
        $this->addSql('DROP TABLE sample_like_user');
    }
}
