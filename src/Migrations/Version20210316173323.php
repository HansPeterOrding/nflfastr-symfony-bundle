<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210316173323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE roster_assignment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE player (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, college VARCHAR(255) NOT NULL, high_school VARCHAR(255) NOT NULL, gsis_id VARCHAR(255) DEFAULT NULL, espn_id VARCHAR(255) DEFAULT NULL, sportradar_id VARCHAR(255) DEFAULT NULL, yahoo_id VARCHAR(255) DEFAULT NULL, rotowire_id VARCHAR(255) DEFAULT NULL, headshot_url VARCHAR(255) NOT NULL, last_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, height_feet INT DEFAULT NULL, height_inches INT DEFAULT NULL, height_cm INT DEFAULT NULL, weight_pounds INT DEFAULT NULL, weight_kilograms INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN player.birth_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE roster_assignment (id INT NOT NULL, team_id INT DEFAULT NULL, player_id INT DEFAULT NULL, season INT NOT NULL, position VARCHAR(255) NOT NULL, depth_chart_position VARCHAR(255) NOT NULL, jersey_number INT NOT NULL, status VARCHAR(255) NOT NULL, last_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C98ABA37296CD8AE ON roster_assignment (team_id)');
        $this->addSql('CREATE INDEX IDX_C98ABA3799E6F5DF ON roster_assignment (player_id)');
        $this->addSql('CREATE TABLE team (id INT NOT NULL, abbreviation VARCHAR(3) NOT NULL, name VARCHAR(255) DEFAULT NULL, status VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE roster_assignment ADD CONSTRAINT FK_C98ABA37296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roster_assignment ADD CONSTRAINT FK_C98ABA3799E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE roster_assignment DROP CONSTRAINT FK_C98ABA3799E6F5DF');
        $this->addSql('ALTER TABLE roster_assignment DROP CONSTRAINT FK_C98ABA37296CD8AE');
        $this->addSql('DROP SEQUENCE player_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE roster_assignment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE roster_assignment');
        $this->addSql('DROP TABLE team');
    }
}
