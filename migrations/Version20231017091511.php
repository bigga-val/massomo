<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231017091511 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription ADD id_option_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D627F1A148 FOREIGN KEY (id_option_id) REFERENCES `option` (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D627F1A148 ON inscription (id_option_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D627F1A148');
        $this->addSql('DROP INDEX IDX_5E90F6D627F1A148 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP id_option_id');
    }
}
