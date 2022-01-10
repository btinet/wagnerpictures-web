<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220109113433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_entry ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_entry ADD CONSTRAINT FK_BA8DBE17727ACA70 FOREIGN KEY (parent_id) REFERENCES menu_entry (id)');
        $this->addSql('CREATE INDEX IDX_BA8DBE17727ACA70 ON menu_entry (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_entry DROP FOREIGN KEY FK_BA8DBE17727ACA70');
        $this->addSql('DROP INDEX IDX_BA8DBE17727ACA70 ON menu_entry');
        $this->addSql('ALTER TABLE menu_entry DROP parent_id');
    }
}
