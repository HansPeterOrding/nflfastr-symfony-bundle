<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210320233141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE drive_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE expected_points_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE play_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE player_assignment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE roster_assignment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_assignment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE win_probability_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE drive (id INT NOT NULL, game_id INT DEFAULT NULL, number INT NOT NULL, real_start_time TIME(0) WITHOUT TIME ZONE DEFAULT NULL, play_count INT DEFAULT NULL, time_of_posession TIME(0) WITHOUT TIME ZONE DEFAULT NULL, first_downs INT DEFAULT NULL, inside_twenty BOOLEAN DEFAULT NULL, ended_with_score BOOLEAN DEFAULT NULL, quarter_start INT DEFAULT NULL, quarter_end INT DEFAULT NULL, yards_penalized INT DEFAULT NULL, start_transition VARCHAR(255) DEFAULT NULL, end_transition VARCHAR(255) DEFAULT NULL, game_clock_start TIME(0) WITHOUT TIME ZONE DEFAULT NULL, game_clock_end TIME(0) WITHOUT TIME ZONE DEFAULT NULL, start_yard_line VARCHAR(30) DEFAULT NULL, end_yard_line VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_681DF58FE48FD905 ON drive (game_id)');
        $this->addSql('CREATE TABLE expected_points (id INT NOT NULL, play_id INT DEFAULT NULL, points NUMERIC(30, 20) NOT NULL, team_type VARCHAR(30) DEFAULT NULL, added BOOLEAN NOT NULL, type VARCHAR(30) DEFAULT NULL, air_or_yac VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_427D3BC525576DBD ON expected_points (play_id)');
        $this->addSql('CREATE UNIQUE INDEX unique_expected_points ON expected_points (play_id, team_type, added, type, air_or_yac)');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, team_id_home INT DEFAULT NULL, team_id_away INT DEFAULT NULL, game_id VARCHAR(30) NOT NULL, old_game_id VARCHAR(30) NOT NULL, season_type VARCHAR(30) NOT NULL, week INT NOT NULL, datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, total_score_home_team INT NOT NULL, total_score_away_team INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_232B318C58F61E5 ON game (team_id_home)');
        $this->addSql('CREATE INDEX IDX_232B318CD206CFE4 ON game (team_id_away)');
        $this->addSql('CREATE TABLE play (id INT NOT NULL, game_id INT DEFAULT NULL, drive_id INT DEFAULT NULL, play_id VARCHAR(30) NOT NULL, possession_team_side_of_field VARCHAR(30) DEFAULT NULL, yard_line100 INT DEFAULT NULL, seconds_remaining_quarter INT DEFAULT NULL, seconds_remaining_half INT DEFAULT NULL, seconds_remaining_game INT DEFAULT NULL, game_half VARCHAR(30) NOT NULL, quarter_end BOOLEAN NOT NULL, score_play BOOLEAN NOT NULL, quarter INT NOT NULL, down INT DEFAULT NULL, goal_to_go BOOLEAN NOT NULL, time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, yards_to_go INT NOT NULL, yards_net INT NOT NULL, description TEXT NOT NULL, type VARCHAR(30) DEFAULT NULL, yards_gained INT NOT NULL, original_play_data JSON NOT NULL, flags_shotgun BOOLEAN NOT NULL, flags_no_huddle BOOLEAN NOT NULL, flags_qb_dropback BOOLEAN NOT NULL, flags_qb_kneel BOOLEAN NOT NULL, flags_qb_spike BOOLEAN NOT NULL, flags_qb_scramble BOOLEAN NOT NULL, flags_punt_blocked BOOLEAN NOT NULL, flags_first_down_rush BOOLEAN NOT NULL, flags_first_down_pass BOOLEAN NOT NULL, flags_first_down_penalty BOOLEAN NOT NULL, flags_third_down_converted BOOLEAN NOT NULL, flags_third_down_failed BOOLEAN NOT NULL, flags_fourth_down_converted BOOLEAN NOT NULL, flags_fourth_down_failed BOOLEAN NOT NULL, flags_incomplete_pass BOOLEAN NOT NULL, flags_touchback BOOLEAN NOT NULL, flags_interception BOOLEAN NOT NULL, flags_punt_inside_twenty BOOLEAN NOT NULL, flags_punt_in_endzone BOOLEAN NOT NULL, flags_punt_out_of_bounds BOOLEAN NOT NULL, flags_punt_downed BOOLEAN NOT NULL, flags_punt_fair_catch BOOLEAN NOT NULL, flags_kickoff_inside_twenty BOOLEAN NOT NULL, flags_kickoff_in_endzone BOOLEAN NOT NULL, flags_kickoff_out_of_bounds BOOLEAN NOT NULL, flags_kickoff_downed BOOLEAN NOT NULL, flags_kickoff_fair_catch BOOLEAN NOT NULL, flags_fumble_forced BOOLEAN NOT NULL, flags_fumble_not_forced BOOLEAN NOT NULL, flags_fumble_out_of_bounds BOOLEAN NOT NULL, flags_solo_tackle BOOLEAN NOT NULL, flags_safety BOOLEAN NOT NULL, flags_penalty BOOLEAN NOT NULL, flags_tackled_for_loss BOOLEAN NOT NULL, flags_fumble_lost BOOLEAN NOT NULL, flags_own_kickoff_recovery BOOLEAN NOT NULL, flags_own_kickoff_recovery_td BOOLEAN NOT NULL, flags_qb_hit BOOLEAN NOT NULL, flags_rush_attempt BOOLEAN NOT NULL, flags_pass_attempt BOOLEAN NOT NULL, flags_sack BOOLEAN NOT NULL, flags_touchdown BOOLEAN NOT NULL, flags_pass_touchdown BOOLEAN NOT NULL, flags_rush_touchdown BOOLEAN NOT NULL, flags_return_touchdown BOOLEAN NOT NULL, flags_extra_point_attempt BOOLEAN NOT NULL, flags_two_point_attempt BOOLEAN NOT NULL, flags_field_goal_attempt BOOLEAN NOT NULL, flags_kickoff_attempt BOOLEAN NOT NULL, flags_punt_attempt BOOLEAN NOT NULL, flags_fumble BOOLEAN NOT NULL, flags_complete_pass BOOLEAN NOT NULL, flags_assist_tackle BOOLEAN NOT NULL, flags_lateral_reception BOOLEAN NOT NULL, flags_lateral_rush BOOLEAN NOT NULL, flags_lateral_return BOOLEAN NOT NULL, flags_lateral_recovery BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E89DEBAE48FD905 ON play (game_id)');
        $this->addSql('CREATE INDEX IDX_5E89DEBA86E5E0C4 ON play (drive_id)');
        $this->addSql('CREATE UNIQUE INDEX unique_play_id ON play (play_id, game_id, drive_id)');
        $this->addSql('COMMENT ON COLUMN play.original_play_data IS \'(DC2Type:json_array)\'');
        $this->addSql('CREATE TABLE player (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, college VARCHAR(255) DEFAULT NULL, high_school VARCHAR(255) DEFAULT NULL, gsis_id VARCHAR(255) DEFAULT NULL, espn_id VARCHAR(255) DEFAULT NULL, sportradar_id VARCHAR(255) DEFAULT NULL, yahoo_id VARCHAR(255) DEFAULT NULL, rotowire_id VARCHAR(255) DEFAULT NULL, headshot_url VARCHAR(255) DEFAULT NULL, last_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, height_feet INT DEFAULT NULL, height_inches INT DEFAULT NULL, height_cm INT DEFAULT NULL, weight_pounds INT DEFAULT NULL, weight_kilograms INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN player.birth_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE player_assignment (id INT NOT NULL, player_id INT DEFAULT NULL, play_id INT DEFAULT NULL, type VARCHAR(50) NOT NULL, yards INT DEFAULT NULL, order_number INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6F60C08799E6F5DF ON player_assignment (player_id)');
        $this->addSql('CREATE INDEX IDX_6F60C08725576DBD ON player_assignment (play_id)');
        $this->addSql('CREATE TABLE roster_assignment (id INT NOT NULL, team_id INT DEFAULT NULL, player_id INT DEFAULT NULL, season INT NOT NULL, position VARCHAR(255) DEFAULT NULL, depth_chart_position VARCHAR(255) DEFAULT NULL, jersey_number INT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, last_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C98ABA37296CD8AE ON roster_assignment (team_id)');
        $this->addSql('CREATE INDEX IDX_C98ABA3799E6F5DF ON roster_assignment (player_id)');
        $this->addSql('CREATE TABLE team (id INT NOT NULL, abbreviation VARCHAR(3) NOT NULL, name VARCHAR(255) DEFAULT NULL, status VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE team_assignment (id INT NOT NULL, team_id INT DEFAULT NULL, play_id INT DEFAULT NULL, type VARCHAR(50) NOT NULL, yards INT DEFAULT NULL, order_number INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E1C367F296CD8AE ON team_assignment (team_id)');
        $this->addSql('CREATE INDEX IDX_E1C367F25576DBD ON team_assignment (play_id)');
        $this->addSql('CREATE TABLE win_probability (id INT NOT NULL, play_id INT DEFAULT NULL, points NUMERIC(30, 20) NOT NULL, team_type VARCHAR(30) DEFAULT NULL, added BOOLEAN NOT NULL, vegas BOOLEAN NOT NULL, type VARCHAR(30) DEFAULT NULL, air_or_yac VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_67D66A0C25576DBD ON win_probability (play_id)');
        $this->addSql('CREATE UNIQUE INDEX unique_win_probabilities ON win_probability (play_id, team_type, added, vegas, type, air_or_yac)');
        $this->addSql('ALTER TABLE drive ADD CONSTRAINT FK_681DF58FE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE expected_points ADD CONSTRAINT FK_427D3BC525576DBD FOREIGN KEY (play_id) REFERENCES play (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C58F61E5 FOREIGN KEY (team_id_home) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CD206CFE4 FOREIGN KEY (team_id_away) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE play ADD CONSTRAINT FK_5E89DEBAE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE play ADD CONSTRAINT FK_5E89DEBA86E5E0C4 FOREIGN KEY (drive_id) REFERENCES drive (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_assignment ADD CONSTRAINT FK_6F60C08799E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player_assignment ADD CONSTRAINT FK_6F60C08725576DBD FOREIGN KEY (play_id) REFERENCES play (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roster_assignment ADD CONSTRAINT FK_C98ABA37296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roster_assignment ADD CONSTRAINT FK_C98ABA3799E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_assignment ADD CONSTRAINT FK_E1C367F296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_assignment ADD CONSTRAINT FK_E1C367F25576DBD FOREIGN KEY (play_id) REFERENCES play (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE win_probability ADD CONSTRAINT FK_67D66A0C25576DBD FOREIGN KEY (play_id) REFERENCES play (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE play DROP CONSTRAINT FK_5E89DEBA86E5E0C4');
        $this->addSql('ALTER TABLE drive DROP CONSTRAINT FK_681DF58FE48FD905');
        $this->addSql('ALTER TABLE play DROP CONSTRAINT FK_5E89DEBAE48FD905');
        $this->addSql('ALTER TABLE expected_points DROP CONSTRAINT FK_427D3BC525576DBD');
        $this->addSql('ALTER TABLE player_assignment DROP CONSTRAINT FK_6F60C08725576DBD');
        $this->addSql('ALTER TABLE team_assignment DROP CONSTRAINT FK_E1C367F25576DBD');
        $this->addSql('ALTER TABLE win_probability DROP CONSTRAINT FK_67D66A0C25576DBD');
        $this->addSql('ALTER TABLE player_assignment DROP CONSTRAINT FK_6F60C08799E6F5DF');
        $this->addSql('ALTER TABLE roster_assignment DROP CONSTRAINT FK_C98ABA3799E6F5DF');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C58F61E5');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318CD206CFE4');
        $this->addSql('ALTER TABLE roster_assignment DROP CONSTRAINT FK_C98ABA37296CD8AE');
        $this->addSql('ALTER TABLE team_assignment DROP CONSTRAINT FK_E1C367F296CD8AE');
        $this->addSql('DROP SEQUENCE drive_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE expected_points_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE play_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE player_assignment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE roster_assignment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_assignment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE win_probability_id_seq CASCADE');
        $this->addSql('DROP TABLE drive');
        $this->addSql('DROP TABLE expected_points');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE play');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_assignment');
        $this->addSql('DROP TABLE roster_assignment');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_assignment');
        $this->addSql('DROP TABLE win_probability');
    }
}
