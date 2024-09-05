<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905165949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces ADD cordonne_id_id INT DEFAULT NULL, ADD adresse_id_id INT DEFAULT NULL, ADD description_id_id INT DEFAULT NULL, ADD category_id_id INT DEFAULT NULL, ADD reference_id_id INT DEFAULT NULL, ADD type_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FCCE421E7 FOREIGN KEY (cordonne_id_id) REFERENCES cordonnes (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F1004EF61 FOREIGN KEY (adresse_id_id) REFERENCES adresses (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F656842B5 FOREIGN KEY (description_id_id) REFERENCES descriptions (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F9777D11E FOREIGN KEY (category_id_id) REFERENCES categorys (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FA9E5FE47 FOREIGN KEY (reference_id_id) REFERENCES `references` (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F714819A0 FOREIGN KEY (type_id_id) REFERENCES types_annonce (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CB988C6FCCE421E7 ON annonces (cordonne_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CB988C6F1004EF61 ON annonces (adresse_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CB988C6F656842B5 ON annonces (description_id_id)');
        $this->addSql('CREATE INDEX IDX_CB988C6F9777D11E ON annonces (category_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CB988C6FA9E5FE47 ON annonces (reference_id_id)');
        $this->addSql('CREATE INDEX IDX_CB988C6F714819A0 ON annonces (type_id_id)');
        $this->addSql('ALTER TABLE medias ADD annonces_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medias ADD CONSTRAINT FK_12D2AF814C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id)');
        $this->addSql('CREATE INDEX IDX_12D2AF814C2885D7 ON medias (annonces_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FCCE421E7');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F1004EF61');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F656842B5');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F9777D11E');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FA9E5FE47');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F714819A0');
        $this->addSql('DROP INDEX UNIQ_CB988C6FCCE421E7 ON annonces');
        $this->addSql('DROP INDEX UNIQ_CB988C6F1004EF61 ON annonces');
        $this->addSql('DROP INDEX UNIQ_CB988C6F656842B5 ON annonces');
        $this->addSql('DROP INDEX IDX_CB988C6F9777D11E ON annonces');
        $this->addSql('DROP INDEX UNIQ_CB988C6FA9E5FE47 ON annonces');
        $this->addSql('DROP INDEX IDX_CB988C6F714819A0 ON annonces');
        $this->addSql('ALTER TABLE annonces DROP cordonne_id_id, DROP adresse_id_id, DROP description_id_id, DROP category_id_id, DROP reference_id_id, DROP type_id_id');
        $this->addSql('ALTER TABLE medias DROP FOREIGN KEY FK_12D2AF814C2885D7');
        $this->addSql('DROP INDEX IDX_12D2AF814C2885D7 ON medias');
        $this->addSql('ALTER TABLE medias DROP annonces_id');
    }
}
