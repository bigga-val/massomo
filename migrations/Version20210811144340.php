<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210811144340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE affectation_cours (id INT AUTO_INCREMENT NOT NULL, cours_id INT DEFAULT NULL, professeur_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, annee_scolaire_id INT DEFAULT NULL, created_at DATETIME NOT NULL, charge_horaire INT DEFAULT NULL, INDEX IDX_21F9EA347ECF78B0 (cours_id), INDEX IDX_21F9EA34BAB22EE9 (professeur_id), INDEX IDX_21F9EA348F5EA509 (classe_id), INDEX IDX_21F9EA349331C741 (annee_scolaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annee_scolaire (id INT AUTO_INCREMENT NOT NULL, etat_id INT DEFAULT NULL, designation VARCHAR(10) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_97150C2BD5E86FF (etat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(100) NOT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_mat (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, created_at DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, options_id INT DEFAULT NULL, titulaire_id INT DEFAULT NULL, designation VARCHAR(100) NOT NULL, is_active TINYINT(1) DEFAULT NULL, INDEX IDX_8F87BF963ADB05F1 (options_id), INDEX IDX_8F87BF96A10273AA (titulaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(100) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, tuteur_id INT DEFAULT NULL, etat_id INT DEFAULT NULL, nom_complet VARCHAR(100) NOT NULL, date_naissance DATE DEFAULT NULL, lieu_naissance VARCHAR(100) DEFAULT NULL, adresse VARCHAR(100) DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_ECA105F7BCF5E72D (categorie_id), INDEX IDX_ECA105F786EC68D8 (tuteur_id), INDEX IDX_ECA105F7D5E86FF (etat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablir_besoin (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, created_at DATE NOT NULL, INDEX IDX_28EE140FB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(50) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat_annee (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(100) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom_complet VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone INT NOT NULL, adresse_mail VARCHAR(255) NOT NULL, created_at DATE NOT NULL, etat TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE frais (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(100) NOT NULL, montant DOUBLE PRECISION NOT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, eleve_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, annee_scolaire_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, created_at DATETIME NOT NULL, token VARCHAR(255) DEFAULT NULL, INDEX IDX_5E90F6D6A6CC7B2 (eleve_id), INDEX IDX_5E90F6D6B03A8386 (created_by_id), INDEX IDX_5E90F6D69331C741 (annee_scolaire_id), INDEX IDX_5E90F6D68F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE local_affeter (id INT AUTO_INCREMENT NOT NULL, id_retrait_id INT DEFAULT NULL, numero_local INT NOT NULL, INDEX IDX_1C26BB47DB72C5AD (id_retrait_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logisticien (id INT AUTO_INCREMENT NOT NULL, nom_logisticien VARCHAR(255) NOT NULL, adresse_mail VARCHAR(255) NOT NULL, telephone INT NOT NULL, created_at DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, id_fournisseur_id INT DEFAULT NULL, id_categorie_id INT DEFAULT NULL, nom_materiel VARCHAR(255) NOT NULL, quantite INT NOT NULL, date_achat DATE NOT NULL, etat TINYINT(1) DEFAULT NULL, INDEX IDX_18D2B0915A6AC879 (id_fournisseur_id), INDEX IDX_18D2B0919F34925F (id_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(100) NOT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, inscription_id INT NOT NULL, frais_id INT DEFAULT NULL, creted_by_id INT DEFAULT NULL, montant_paye DOUBLE PRECISION DEFAULT NULL, montant_reste DOUBLE PRECISION DEFAULT NULL, created_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, INDEX IDX_B1DC7A1E5DAC5993 (inscription_id), INDEX IDX_B1DC7A1EBF516DC4 (frais_id), INDEX IDX_B1DC7A1E6E39655A (creted_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, nom_complet VARCHAR(150) NOT NULL, telephone VARCHAR(15) DEFAULT NULL, adresse VARCHAR(100) DEFAULT NULL, lieu_naissance VARCHAR(255) DEFAULT NULL, date_naissance DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE retrait_mat (id INT AUTO_INCREMENT NOT NULL, id_materiel_id INT DEFAULT NULL, motif VARCHAR(255) NOT NULL, created_at DATE NOT NULL, quantite INT NOT NULL, INDEX IDX_4FBA6656E9AC758 (id_materiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuteur (id INT AUTO_INCREMENT NOT NULL, nom_complet VARCHAR(100) NOT NULL, telephone VARCHAR(15) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom_complet VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affectation_cours ADD CONSTRAINT FK_21F9EA347ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE affectation_cours ADD CONSTRAINT FK_21F9EA34BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE affectation_cours ADD CONSTRAINT FK_21F9EA348F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE affectation_cours ADD CONSTRAINT FK_21F9EA349331C741 FOREIGN KEY (annee_scolaire_id) REFERENCES annee_scolaire (id)');
        $this->addSql('ALTER TABLE annee_scolaire ADD CONSTRAINT FK_97150C2BD5E86FF FOREIGN KEY (etat_id) REFERENCES etat_annee (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF963ADB05F1 FOREIGN KEY (options_id) REFERENCES `option` (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96A10273AA FOREIGN KEY (titulaire_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F786EC68D8 FOREIGN KEY (tuteur_id) REFERENCES tuteur (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE etablir_besoin ADD CONSTRAINT FK_28EE140FB03A8386 FOREIGN KEY (created_by_id) REFERENCES logisticien (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D69331C741 FOREIGN KEY (annee_scolaire_id) REFERENCES annee_scolaire (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D68F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE local_affeter ADD CONSTRAINT FK_1C26BB47DB72C5AD FOREIGN KEY (id_retrait_id) REFERENCES retrait_mat (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B0915A6AC879 FOREIGN KEY (id_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B0919F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie_mat (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E5DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EBF516DC4 FOREIGN KEY (frais_id) REFERENCES frais (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E6E39655A FOREIGN KEY (creted_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE retrait_mat ADD CONSTRAINT FK_4FBA6656E9AC758 FOREIGN KEY (id_materiel_id) REFERENCES materiel (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE affectation_cours DROP FOREIGN KEY FK_21F9EA349331C741');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D69331C741');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7BCF5E72D');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B0919F34925F');
        $this->addSql('ALTER TABLE affectation_cours DROP FOREIGN KEY FK_21F9EA348F5EA509');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D68F5EA509');
        $this->addSql('ALTER TABLE affectation_cours DROP FOREIGN KEY FK_21F9EA347ECF78B0');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A6CC7B2');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7D5E86FF');
        $this->addSql('ALTER TABLE annee_scolaire DROP FOREIGN KEY FK_97150C2BD5E86FF');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B0915A6AC879');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EBF516DC4');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E5DAC5993');
        $this->addSql('ALTER TABLE etablir_besoin DROP FOREIGN KEY FK_28EE140FB03A8386');
        $this->addSql('ALTER TABLE retrait_mat DROP FOREIGN KEY FK_4FBA6656E9AC758');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF963ADB05F1');
        $this->addSql('ALTER TABLE affectation_cours DROP FOREIGN KEY FK_21F9EA34BAB22EE9');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96A10273AA');
        $this->addSql('ALTER TABLE local_affeter DROP FOREIGN KEY FK_1C26BB47DB72C5AD');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F786EC68D8');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6B03A8386');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E6E39655A');
        $this->addSql('DROP TABLE affectation_cours');
        $this->addSql('DROP TABLE annee_scolaire');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_mat');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE etablir_besoin');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE etat_annee');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE frais');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE local_affeter');
        $this->addSql('DROP TABLE logisticien');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE retrait_mat');
        $this->addSql('DROP TABLE tuteur');
        $this->addSql('DROP TABLE user');
    }
}
