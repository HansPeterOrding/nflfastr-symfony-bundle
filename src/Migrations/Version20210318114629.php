<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318114629 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE drive ADD real_start_time TIME(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD play_count INT DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD time_of_posession TIME(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD first_downs INT DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD inside_twenty BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD ended_with_score BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD quarter_start INT DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD quarter_end INT DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD yards_penalized INT DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD start_transition VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD end_transition VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD game_clock_start TIME(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD game_clock_end TIME(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD start_yard_line INT DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD end_yard_line INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE drive DROP real_start_time');
        $this->addSql('ALTER TABLE drive DROP play_count');
        $this->addSql('ALTER TABLE drive DROP time_of_posession');
        $this->addSql('ALTER TABLE drive DROP first_downs');
        $this->addSql('ALTER TABLE drive DROP inside_twenty');
        $this->addSql('ALTER TABLE drive DROP ended_with_score');
        $this->addSql('ALTER TABLE drive DROP quarter_start');
        $this->addSql('ALTER TABLE drive DROP quarter_end');
        $this->addSql('ALTER TABLE drive DROP yards_penalized');
        $this->addSql('ALTER TABLE drive DROP start_transition');
        $this->addSql('ALTER TABLE drive DROP end_transition');
        $this->addSql('ALTER TABLE drive DROP game_clock_start');
        $this->addSql('ALTER TABLE drive DROP game_clock_end');
        $this->addSql('ALTER TABLE drive DROP start_yard_line');
        $this->addSql('ALTER TABLE drive DROP end_yard_line');
    }
}
