<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Repository;

interface PlayRepositoryInterface
{
	const DB_COLUMN_FLAGS_SHOTGUN = 'flags_shotgun';
	const DB_COLUMN_FLAGS_NO_HUDDLE = 'flags_no_huddle';
	const DB_COLUMN_FLAGS_QB_DROPBACK = 'flags_qb_dropback';
	const DB_COLUMN_FLAGS_QB_KNEEL = 'flags_qb_kneel';
	const DB_COLUMN_FLAGS_QB_SPIKE = 'flags_qb_spike';
	const DB_COLUMN_FLAGS_QB_SCRAMBLE = 'flags_qb_scramble';
	const DB_COLUMN_FLAGS_PUNT_BLOCKED = 'flags_punt_blocked';
	const DB_COLUMN_FLAGS_OUT_OF_BOUNDS = 'flags_out_of_bounds';
	const DB_COLUMN_FLAGS_FIRST_DOWN_RUSH = 'flags_first_down_rush';
	const DB_COLUMN_FLAGS_FIRST_DOWN_PASS = 'flags_first_down_pass';
	const DB_COLUMN_FLAGS_FIRST_DOWN_PENALTY = 'flags_first_down_penalty';
	const DB_COLUMN_FLAGS_THIRD_DOWN_CONVERTED = 'flags_third_down_converted';
	const DB_COLUMN_FLAGS_THIRD_DOWN_FAILED = 'flags_third_down_failed';
	const DB_COLUMN_FLAGS_FOURTH_DOWN_CONVERTED = 'flags_fourth_down_converted';
	const DB_COLUMN_FLAGS_FOURTH_DOWN_FAILED = 'flags_fourth_down_failed';
	const DB_COLUMN_FLAGS_INCOMPLETE_PASS = 'flags_incomplete_pass';
	const DB_COLUMN_FLAGS_TOUCHBACK = 'flags_touchback';
	const DB_COLUMN_FLAGS_INTERCEPTION = 'flags_interception';
	const DB_COLUMN_FLAGS_PUNT_INSIDE_TWENTY = 'flags_punt_inside_twenty';
	const DB_COLUMN_FLAGS_PUNT_IN_ENDZONE = 'flags_punt_in_endzone';
	const DB_COLUMN_FLAGS_PUNT_OUT_OF_BOUNDS = 'flags_punt_out_of_bounds';
	const DB_COLUMN_FLAGS_PUNT_DOWNED = 'flags_punt_downed';
	const DB_COLUMN_FLAGS_PUNT_FAIR_CATCH = 'flags_punt_fair_catch';
	const DB_COLUMN_FLAGS_KICKOFF_INSIDE_TWENTY = 'flags_kickoff_inside_twenty';
	const DB_COLUMN_FLAGS_KICKOFF_IN_ENDZONE = 'flags_kickoff_in_endzone';
	const DB_COLUMN_FLAGS_KICKOFF_OUT_OF_BOUNDS = 'flags_kickoff_out_of_bounds';
	const DB_COLUMN_FLAGS_KICKOFF_DOWNED = 'flags_kickoff_downed';
	const DB_COLUMN_FLAGS_KICKOFF_FAIR_CATCH = 'flags_kickoff_fair_catch';
	const DB_COLUMN_FLAGS_FUMBLE_FORCED = 'flags_fumble_forced';
	const DB_COLUMN_FLAGS_FUMBLE_NOT_FORCED = 'flags_fumble_not_forced';
	const DB_COLUMN_FLAGS_FUMBLE_OUT_OF_BOUNDS = 'flags_fumble_out_of_bounds';
	const DB_COLUMN_FLAGS_SOLO_TACKLE = 'flags_solo_tackle';
	const DB_COLUMN_FLAGS_SAFETY = 'flags_safety';
	const DB_COLUMN_FLAGS_PENALTY = 'flags_penalty';
	const DB_COLUMN_FLAGS_TACKLED_FOR_LOSS = 'flags_tackled_for_loss';
	const DB_COLUMN_FLAGS_FUMBLE_LOST = 'flags_fumble_lost';
	const DB_COLUMN_FLAGS_OWN_KICKOFF_RECOVERY = 'flags_own_kickoff_recovery';
	const DB_COLUMN_FLAGS_OWN_KICKOFF_RECOVERY_TD = 'flags_own_kickoff_recovery_td';
	const DB_COLUMN_FLAGS_QB_HIT = 'flags_qb_hit';
	const DB_COLUMN_FLAGS_RUSH_ATTEMPT = 'flags_rush_attempt';
	const DB_COLUMN_FLAGS_PASS_ATTEMPT = 'flags_pass_attempt';
	const DB_COLUMN_FLAGS_SACK = 'flags_sack';
	const DB_COLUMN_FLAGS_TOUCHDOWN = 'flags_touchdown';
	const DB_COLUMN_FLAGS_PASS_TOUCHDOWN = 'flags_pass_touchdown';
	const DB_COLUMN_FLAGS_RUSH_TOUCHDOWN = 'flags_rush_touchdown';
	const DB_COLUMN_FLAGS_RETURN_TOUCHDOWN = 'flags_return_touchdown';
	const DB_COLUMN_FLAGS_EXTRA_POINT_ATTEMPT = 'flags_extra_point_attempt';
	const DB_COLUMN_FLAGS_TWO_POINT_ATTEMPT = 'flags_two_point_attempt';
	const DB_COLUMN_FLAGS_FIELD_GOAL_ATTEMPT = 'flags_field_goal_attempt';
	const DB_COLUMN_FLAGS_KICKOFF_ATTEMPT = 'flags_kickoff_attempt';
	const DB_COLUMN_FLAGS_PUNT_ATTEMPT = 'flags_punt_attempt';
	const DB_COLUMN_FLAGS_FUMBLE = 'flags_fumble';
	const DB_COLUMN_FLAGS_COMPLETE_PASS = 'flags_complete_pass';
	const DB_COLUMN_FLAGS_ASSIST_TACKLE = 'flags_assist_tackle';
	const DB_COLUMN_FLAGS_LATERAL_RECEPTION = 'flags_lateral_reception';
	const DB_COLUMN_FLAGS_LATERAL_RUSH = 'flags_lateral_rush';
	const DB_COLUMN_FLAGS_LATERAL_RETURN = 'flags_lateral_return';
	const DB_COLUMN_FLAGS_LATERAL_RECOVERY = 'flags_lateral_recovery';
	const DB_COLUMN_FLAGS_SPECIAL = 'flags_special';

	const DB_COLUMN_PLAY_RESULT_FIELD_GOAL_RESULT  = 'playresults_field_goal_result';
	const DB_COLUMN_PLAY_RESULT_EXTRA_POINT_RESULT  = 'playresults_extra_point_result';
	const DB_COLUMN_PLAY_RESULT_TWO_POINT_CONVERSION_RESULT  = 'playresults_two_point_conversion_result';
	const DB_COLUMN_PLAY_RESULT_REPLAY_OR_CHALLENGE_RESULT  = 'playresults_replay_or_challenge_result';
	const DB_COLUMN_PLAY_RESULT_SERIES_RESULT  = 'playresults_series_result';
	const DB_COLUMN_PLAY_RESULT_KICK_DISTANCE  = 'playresults_kick_distance';

	const DB_COLUMN_YARDS_NET = 'yards_net';
	const DB_COLUMN_YARDS_TO_GO = 'yards_to_go';
	const DB_COLUMN_YARDS_GAINED = 'yards_gained';
	const DB_COLUMN_YARDS_AIR = 'yards_air';
	const DB_COLUMN_YARDS_AFTER_CATCH = 'yards_after_catch';
	const DB_COLUMN_YARDS_PASSING = 'yards_passing';
	const DB_COLUMN_YARDS_RECEIVING = 'yards_receiving';
	const DB_COLUMN_YARDS_RUSHING = 'yards_rushing';
	const DB_COLUMN_YARDS_LATERAL_RECEIVING = 'yards_lateral_receiving';
	const DB_COLUMN_YARDS_LATERAL_RUSHING = 'yards_lateral_rushing';
	const DB_COLUMN_YARDS_FUMBLE_RECOVERY1 = 'yards_fumble_recovery1';
	const DB_COLUMN_YARDS_FUMBLE_RECOVERY2 = 'yards_fumble_recovery2';
	const DB_COLUMN_YARDS_RETURN = 'yards_return';
	const DB_COLUMN_YARDS_PENALTY = 'yards_penalty';
	const DB_COLUMN_YARDS_DRIVE_PENALIZED = 'yards_drive_penalized';
}
