<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318152755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP CONSTRAINT fk_232b318c296cd8ae');
        $this->addSql('DROP INDEX idx_232b318c296cd8ae');
        $this->addSql('ALTER TABLE game ADD team_id_away INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game RENAME COLUMN team_id TO team_id_home');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C58F61E5 FOREIGN KEY (team_id_home) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CD206CFE4 FOREIGN KEY (team_id_away) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_232B318C58F61E5 ON game (team_id_home)');
        $this->addSql('CREATE INDEX IDX_232B318CD206CFE4 ON game (team_id_away)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C58F61E5');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318CD206CFE4');
        $this->addSql('DROP INDEX IDX_232B318C58F61E5');
        $this->addSql('DROP INDEX IDX_232B318CD206CFE4');
        $this->addSql('ALTER TABLE game ADD team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game DROP team_id_home');
        $this->addSql('ALTER TABLE game DROP team_id_away');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT fk_232b318c296cd8ae FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_232b318c296cd8ae ON game (team_id)');
    }
}
