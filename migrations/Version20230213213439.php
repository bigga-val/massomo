<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213213439 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_content ADD classe_id INT NOT NULL, ADD prof_id INT NOT NULL');
        $this->addSql('ALTER TABLE cours_content ADD CONSTRAINT FK_BDC359D28F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE cours_content ADD CONSTRAINT FK_BDC359D2ABC1F7FE FOREIGN KEY (prof_id) REFERENCES professeur (id)');
        $this->addSql('CREATE INDEX IDX_BDC359D28F5EA509 ON cours_content (classe_id)');
        $this->addSql('CREATE INDEX IDX_BDC359D2ABC1F7FE ON cours_content (prof_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_content DROP FOREIGN KEY FK_BDC359D28F5EA509');
        $this->addSql('ALTER TABLE cours_content DROP FOREIGN KEY FK_BDC359D2ABC1F7FE');
        $this->addSql('DROP INDEX IDX_BDC359D28F5EA509 ON cours_content');
        $this->addSql('DROP INDEX IDX_BDC359D2ABC1F7FE ON cours_content');
        $this->addSql('ALTER TABLE cours_content DROP classe_id, DROP prof_id');
    }
}
