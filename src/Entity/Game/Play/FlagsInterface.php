<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

interface FlagsInterface
{
	const COLUMN_SHOTGUN = 'shotgun';
	const COLUMN_NO_HUDDLE = 'no_huddle';
	const COLUMN_QB_DROPBACK = 'qb_dropback';
	const COLUMN_QB_KNEEL = 'qb_kneel';
	const COLUMN_QB_SPIKE = 'qb_spike';
	const COLUMN_QB_SCRAMBLE = 'qb_scramble';
	const COLUMN_PUNT_BLOCKED = 'punt_blocked';
	const COLUMN_OUT_OF_BOUNDS = 'out_of_bounds';
	const COLUMN_FIRST_DOWN_RUSH = 'first_down_rush';
	const COLUMN_FIRST_DOWN_PASS = 'first_down_pass';
	const COLUMN_FIRST_DOWN_PENALTY = 'first_down_penalty';
	const COLUMN_THIRD_DOWN_CONVERTED = 'third_down_converted';
	const COLUMN_THIRD_DOWN_FAILED = 'third_down_failed';
	const COLUMN_FOURTH_DOWN_CONVERTED = 'fourth_down_converted';
	const COLUMN_FOURTH_DOWN_FAILED = 'fourth_down_failed';
	const COLUMN_INCOMPLETE_PASS = 'incomplete_pass';
	const COLUMN_TOUCHBACK = 'touchback';
	const COLUMN_INTERCEPTION = 'interception';
	const COLUMN_PUNT_INSIDE_TWENTY = 'punt_inside_twenty';
	const COLUMN_PUNT_IN_ENDZONE = 'punt_in_endzone';
	const COLUMN_PUNT_OUT_OF_BOUNDS = 'punt_out_of_bounds';
	const COLUMN_PUNT_DOWNED = 'punt_downed';
	const COLUMN_PUNT_FAIR_CATCH = 'punt_fair_catch';
	const COLUMN_KICKOFF_INSIDE_TWENTY = 'kickoff_inside_twenty';
	const COLUMN_KICKOFF_IN_ENDZONE = 'kickoff_in_endzone';
	const COLUMN_KICKOFF_OUT_OF_BOUNDS = 'kickoff_out_of_bounds';
	const COLUMN_KICKOFF_DOWNED = 'kickoff_downed';
	const COLUMN_KICKOFF_FAIR_CATCH = 'kickoff_fair_catch';
	const COLUMN_FUMBLE_FORCED = 'fumble_forced';
	const COLUMN_FUMBLE_NOT_FORCED = 'fumble_not_forced';
	const COLUMN_FUMBLE_OUT_OF_BOUNDS = 'fumble_out_of_bounds';
	const COLUMN_SOLO_TACKLE = 'solo_tackle';
	const COLUMN_SAFETY = 'safety';
	const COLUMN_PENALTY = 'penalty';
	const COLUMN_TACKLED_FOR_LOSS = 'tackled_for_loss';
	const COLUMN_FUMBLE_LOST = 'fumble_lost';
	const COLUMN_OWN_KICKOFF_RECOVERY = 'own_kickoff_recovery';
	const COLUMN_OWN_KICKOFF_RECOVERY_TD = 'own_kickoff_recovery_td';
	const COLUMN_QB_HIT = 'qb_hit';
	const COLUMN_RUSH_ATTEMPT = 'rush_attempt';
	const COLUMN_PASS_ATTEMPT = 'pass_attempt';
	const COLUMN_SACK = 'sack';
	const COLUMN_TOUCHDOWN = 'touchdown';
	const COLUMN_PASS_TOUCHDOWN = 'pass_touchdown';
	const COLUMN_RUSH_TOUCHDOWN = 'rush_touchdown';
	const COLUMN_RETURN_TOUCHDOWN = 'return_touchdown';
	const COLUMN_EXTRA_POINT_ATTEMPT = 'extra_point_attempt';
	const COLUMN_TWO_POINT_ATTEMPT = 'two_point_attempt';
	const COLUMN_FIELD_GOAL_ATTEMPT = 'field_goal_attempt';
	const COLUMN_KICKOFF_ATTEMPT = 'kickoff_attempt';
	const COLUMN_PUNT_ATTEMPT = 'punt_attempt';
	const COLUMN_FUMBLE = 'fumble';
	const COLUMN_COMPLETE_PASS = 'complete_pass';
	const COLUMN_ASSIST_TACKLE = 'assist_tackle';
	const COLUMN_LATERAL_RECEPTION = 'lateral_reception';
	const COLUMN_LATERAL_RUSH = 'lateral_rush';
	const COLUMN_LATERAL_RETURN = 'lateral_return';
	const COLUMN_LATERAL_RECOVERY = 'lateral_recovery';
	const COLUMN_SPECIAL = 'special';
}
