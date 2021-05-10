<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406161933 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expected_points ALTER points DROP NOT NULL');
        $this->addSql('ALTER TABLE game ALTER game_id DROP NOT NULL');
        $this->addSql('ALTER TABLE game ALTER old_game_id DROP NOT NULL');
        $this->addSql('ALTER TABLE game ALTER season_type DROP NOT NULL');
        $this->addSql('ALTER TABLE game ALTER week DROP NOT NULL');
        $this->addSql('ALTER TABLE game ALTER datetime DROP NOT NULL');
        $this->addSql('ALTER TABLE game ALTER total_score_home_team DROP NOT NULL');
        $this->addSql('ALTER TABLE game ALTER total_score_away_team DROP NOT NULL');
        $this->addSql('ALTER TABLE play ADD play_deleted BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE play ADD playResults_extra_point_result VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD playResults_field_goal_result VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD playResults_replay_or_challenge_result VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD playResults_series_result VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD playResults_two_point_conversion_result VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD playResults_kick_distance INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD yards_air INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD yards_after_catch INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD yards_passing INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD yards_receiving INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD yards_rushing INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD yards_lateral_receiving INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD yards_lateral_rushing INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD yards_fumble_recovery1 INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD yards_funble_recovery2 INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD yards_return INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD yards_penalty INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ADD yards_drive_penalized INT DEFAULT NULL');
        $this->addSql('ALTER TABLE play ALTER play_id DROP NOT NULL');
        $this->addSql('ALTER TABLE play ALTER game_half DROP NOT NULL');
        $this->addSql('ALTER TABLE play ALTER quarter DROP NOT NULL');
        $this->addSql('ALTER TABLE play ALTER yards_to_go DROP NOT NULL');
        $this->addSql('ALTER TABLE play ALTER description DROP NOT NULL');
        $this->addSql('ALTER TABLE play ALTER yards_gained DROP NOT NULL');
        $this->addSql('ALTER TABLE player ALTER first_name DROP NOT NULL');
        $this->addSql('ALTER TABLE player ALTER last_name DROP NOT NULL');
        $this->addSql('ALTER TABLE player ALTER last_updated DROP NOT NULL');
        $this->addSql('ALTER TABLE player_assignment ALTER type DROP NOT NULL');
        $this->addSql('ALTER TABLE roster_assignment ALTER season DROP NOT NULL');
        $this->addSql('ALTER TABLE roster_assignment ALTER last_updated DROP NOT NULL');
        $this->addSql('ALTER TABLE team ALTER status DROP NOT NULL');
        $this->addSql('ALTER TABLE team_assignment ALTER type DROP NOT NULL');
        $this->addSql('ALTER TABLE win_probability ALTER points DROP NOT NULL');
		$this->addSql('ALTER TABLE game ADD season INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE play DROP play_deleted');
        $this->addSql('ALTER TABLE play DROP playResults_extra_point_result');
        $this->addSql('ALTER TABLE play DROP playResults_field_goal_result');
        $this->addSql('ALTER TABLE play DROP playResults_replay_or_challenge_result');
        $this->addSql('ALTER TABLE play DROP playResults_series_result');
        $this->addSql('ALTER TABLE play DROP playResults_two_point_conversion_result');
        $this->addSql('ALTER TABLE play DROP playResults_kick_distance');
        $this->addSql('ALTER TABLE play DROP yards_air');
        $this->addSql('ALTER TABLE play DROP yards_after_catch');
        $this->addSql('ALTER TABLE play DROP yards_passing');
        $this->addSql('ALTER TABLE play DROP yards_receiving');
        $this->addSql('ALTER TABLE play DROP yards_rushing');
        $this->addSql('ALTER TABLE play DROP yards_lateral_receiving');
        $this->addSql('ALTER TABLE play DROP yards_lateral_rushing');
        $this->addSql('ALTER TABLE play DROP yards_fumble_recovery1');
        $this->addSql('ALTER TABLE play DROP yards_funble_recovery2');
        $this->addSql('ALTER TABLE play DROP yards_return');
        $this->addSql('ALTER TABLE play DROP yards_penalty');
        $this->addSql('ALTER TABLE play DROP yards_drive_penalized');
        $this->addSql('ALTER TABLE play ALTER play_id SET NOT NULL');
        $this->addSql('ALTER TABLE play ALTER game_half SET NOT NULL');
        $this->addSql('ALTER TABLE play ALTER quarter SET NOT NULL');
        $this->addSql('ALTER TABLE play ALTER description SET NOT NULL');
        $this->addSql('ALTER TABLE play ALTER yards_gained SET NOT NULL');
        $this->addSql('ALTER TABLE play ALTER yards_to_go SET NOT NULL');
        $this->addSql('ALTER TABLE expected_points ALTER points SET NOT NULL');
        $this->addSql('ALTER TABLE team ALTER status SET NOT NULL');
        $this->addSql('ALTER TABLE player ALTER first_name SET NOT NULL');
        $this->addSql('ALTER TABLE player ALTER last_name SET NOT NULL');
        $this->addSql('ALTER TABLE player ALTER last_updated SET NOT NULL');
        $this->addSql('ALTER TABLE player_assignment ALTER type SET NOT NULL');
        $this->addSql('ALTER TABLE roster_assignment ALTER season SET NOT NULL');
        $this->addSql('ALTER TABLE roster_assignment ALTER last_updated SET NOT NULL');
        $this->addSql('ALTER TABLE team_assignment ALTER type SET NOT NULL');
        $this->addSql('ALTER TABLE win_probability ALTER points SET NOT NULL');
        $this->addSql('ALTER TABLE game ALTER game_id SET NOT NULL');
        $this->addSql('ALTER TABLE game ALTER old_game_id SET NOT NULL');
        $this->addSql('ALTER TABLE game ALTER season_type SET NOT NULL');
        $this->addSql('ALTER TABLE game ALTER week SET NOT NULL');
        $this->addSql('ALTER TABLE game ALTER datetime SET NOT NULL');
        $this->addSql('ALTER TABLE game ALTER total_score_home_team SET NOT NULL');
        $this->addSql('ALTER TABLE game ALTER total_score_away_team SET NOT NULL');
		$this->addSql('ALTER TABLE game DROP season');
    }
}
