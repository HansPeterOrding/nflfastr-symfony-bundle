<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

interface PlayerAssignmentConverterInterface extends CsvConverterInterface
{
	const COLUMN_TD_PLAYER_ID = 'td_player_id';
	const COLUMN_PASSER_PLAYER_ID = 'passer_player_id';
	const COLUMN_RECEIVER_PLAYER_ID = 'receiver_player_id';
	const COLUMN_RUSHER_PLAYER_ID = 'rusher_player_id';
	const COLUMN_LATERAL_RECEIVER_PLAYER_ID = 'lateral_receiver_player_id';
	const COLUMN_LATERAL_RUSHER_PLAYER_ID = 'lateral_rusher_player_id';
	const COLUMN_LATERAL_SACK_PLAYER_ID = 'lateral_sack_player_id';
	const COLUMN_INTERCEPTION_PLAYER_ID = 'interception_player_id';
	const COLUMN_LATERAL_INTERCEPTION_PLAYER_ID = 'lateral_interception_player_id';
	const COLUMN_PUNT_RETURNER_PLAYER_ID = 'punt_returner_player_id';
	const COLUMN_LATERAL_PUNT_RETURNER_PLAYER_ID = 'lateral_punt_returner_player_id';
	const COLUMN_KICKOFF_RETURNER_PLAYER_ID = 'kickoff_returner_player_id';
	const COLUMN_LATERAL_KICKOFF_RETURNER_PLAYER_ID = 'lateral_kickoff_returner_player_id';
	const COLUMN_PUNTER_PLAYER_ID = 'punter_player_id';
	const COLUMN_KICKER_PLAYER_ID = 'kicker_player_id';
	const COLUMN_OWN_KICKOFF_RECOVERY_PLAYER_ID = 'own_kickoff_recovery_player_id';
	const COLUMN_BLOCKED_PLAYER_ID = 'blocked_player_id';
	const COLUMN_TACKLE_FOR_LOSS_1_PLAYER_ID = 'tackle_for_loss_1_player_id';
	const COLUMN_TACKLE_FOR_LOSS_2_PLAYER_ID = 'tackle_for_loss_2_player_id';
	const COLUMN_QB_HIT_1_PLAYER_ID = 'qb_hit_1_player_id';
	const COLUMN_QB_HIT_2_PLAYER_ID = 'qb_hit_2_player_id';
	const COLUMN_FORCED_FUMBLE_PLAYER_1_PLAYER_ID = 'forced_fumble_player_1_player_id';
	const COLUMN_FORCED_FUMBLE_PLAYER_2_PLAYER_ID = 'forced_fumble_player_2_player_id';
	const COLUMN_SOLO_TACKLE_1_PLAYER_ID = 'solo_tackle_1_player_id';
	const COLUMN_SOLO_TACKLE_2_PLAYER_ID = 'solo_tackle_2_player_id';
	const COLUMN_ASSIST_TACKLE_1_PLAYER_ID = 'assist_tackle_1_player_id';
	const COLUMN_ASSIST_TACKLE_2_PLAYER_ID = 'assist_tackle_2_player_id';
	const COLUMN_ASSIST_TACKLE_3_PLAYER_ID = 'assist_tackle_3_player_id';
	const COLUMN_ASSIST_TACKLE_4_PLAYER_ID = 'assist_tackle_4_player_id';
	const COLUMN_TACKLE_WITH_ASSIST_1_PLAYER_ID = 'tackle_with_assist_1_player_id';
	const COLUMN_TACKLE_WITH_ASSIST_2_PLAYER_ID = 'tackle_with_assist_2_player_id';
	const COLUMN_PASS_DEFENSE_1_PLAYER_ID = 'pass_defense_1_player_id';
	const COLUMN_PASS_DEFENSE_2_PLAYER_ID = 'pass_defense_2_player_id';
	const COLUMN_FUMBLED_1_PLAYER_ID = 'fumbled_1_player_id';
	const COLUMN_FUMBLED_2_PLAYER_ID = 'fumbled_2_player_id';
	const COLUMN_FUMBLE_RECOVERY_1_PLAYER_ID = 'fumble_recovery_1_player_id';
	const COLUMN_FUMBLE_RECOVERY_2_PLAYER_ID = 'fumble_recovery_2_player_id';
	const COLUMN_PENALTY_PLAYER_ID = 'penalty_player_id';
	const COLUMN_FANTASY_PLAYER_ID = 'fantasy_player_id';

	const COLUMN_PASSING_YARDS = 'passing_yards';
	const COLUMN_RECEIVING_YARDS = 'receiving_yards';
	const COLUMN_RUSHING_YARDS = 'rushing_yards';
	const COLUMN_LATERAL_RECEIVING_YARDS = 'lateral_receiving_yards';
	const COLUMN_LATERAL_RUSHING_YARDS = 'lateral_rushing_yards';
	const COLUMN_FUMBLE_RECOVERY_1_YARDS = 'fumble_recovery_1_yards';
	const COLUMN_FUMBLE_RECOVERY_2_YARDS = 'fumble_recovery_2_yards';
	const COLUMN_RETURN_YARDS = 'return_yards';
	const COLUMN_PENALTY_YARDS = 'penalty_yards';

	public function buildPlayerAssignments(array $record): iterable;
}
