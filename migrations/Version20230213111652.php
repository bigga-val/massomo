<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213111652 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours ADD promotion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C139DF194 FOREIGN KEY (promotion_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C139DF194 ON cours (promotion_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C139DF194');
        $this->addSql('DROP INDEX IDX_FDCA8C9C139DF194 ON cours');
        $this->addSql('ALTER TABLE cours DROP promotion_id');
    }
}
