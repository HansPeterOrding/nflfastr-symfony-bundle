<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

interface TeamAssignmentConverterInterface extends CsvConverterInterface
{
	const COLUMN_POSTEAM = 'posteam';
	const COLUMN_DEFTEAM = 'defteam';
	const COLUMN_TIMEOUT_TEAM = 'timeout_team';
	const COLUMN_TD_TEAM = 'td_team';
	const COLUMN_FORCED_FUMBLE_PLAYER_1_TEAM = 'forced_fumble_player_1_team';
	const COLUMN_FORCED_FUMBLE_PLAYER_2_TEAM = 'forced_fumble_player_2_team';
	const COLUMN_SOLO_TACKLE_1_TEAM = 'solo_tackle_1_team';
	const COLUMN_SOLO_TACKLE_2_TEAM = 'solo_tackle_2_team';
	const COLUMN_ASSIST_TACKLE_1_TEAM = 'assist_tackle_1_team';
	const COLUMN_ASSIST_TACKLE_2_TEAM = 'assist_tackle_2_team';
	const COLUMN_ASSIST_TACKLE_3_TEAM = 'assist_tackle_3_team';
	const COLUMN_ASSIST_TACKLE_4_TEAM = 'assist_tackle_4_team';
	const COLUMN_TACKLE_WITH_ASSIST_1_TEAM = 'tackle_with_assist_1_team';
	const COLUMN_TACKLE_WITH_ASSIST_2_TEAM = 'tackle_with_assist_2_team';
	const COLUMN_FUMBLED_1_TEAM = 'fumbled_1_team';
	const COLUMN_FUMBLED_2_TEAM = 'fumbled_2_team';
	const COLUMN_FUMBLE_RECOVERY_1_TEAM = 'fumble_recovery_1_team';
	const COLUMN_FUMBLE_RECOVERY_2_TEAM = 'fumble_recovery_2_team';
	const COLUMN_RETURN_TEAM = 'return_team';
	const COLUMN_PENALTY_TEAM = 'penalty_team';

	const COLUMN_FUMBLE_RECOVERY_1_YARDS = 'fumble_recovery_1_yards';
	const COLUMN_FUMBLE_RECOVERY_2_YARDS = 'fumble_recovery_2_yards';
	const COLUMN_RETURN_YARDS = 'return_yards';
	const COLUMN_PENALTY_YARDS = 'penalty_yards';

	public function buildTeamAssignments(array $record): iterable;
}
