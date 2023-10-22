<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231022104838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF963ADB05F1');
        $this->addSql('DROP INDEX IDX_8F87BF963ADB05F1 ON classe');
        $this->addSql('ALTER TABLE classe DROP options_id');
        $this->addSql('ALTER TABLE eleve ADD genre VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe ADD options_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF963ADB05F1 FOREIGN KEY (options_id) REFERENCES `option` (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF963ADB05F1 ON classe (options_id)');
        $this->addSql('ALTER TABLE eleve DROP genre');
    }
}
