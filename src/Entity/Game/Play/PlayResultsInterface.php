<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

interface PlayResultsInterface
{
	const COLUMN_FIELD_GOAL_RESULT = 'field_goal_result';
	const COLUMN_EXTRA_POINT_RESULT = 'extra_point_result';
	const COLUMN_TWO_POINT_CONV_RESULT = 'two_point_conv_result';
	const COLUMN_REPLAY_OR_CHALLENGE_RESULT = 'replay_or_challenge_result';
	const COLUMN_SERIES_RESULT = 'series_result';
	const COLUMN_KICK_DISTANCE = 'kick_distance';

	const FIELD_GOAL_RESULT_MADE = 'made';
	const FIELD_GOAL_RESULT_MISSED = 'missed';
	const FIELD_GOAL_RESULT_BLOCKED = 'blocked';

	const EXTRA_POINT_RESULT_GOOD = 'good';
	const EXTRA_POINT_RESULT_FAILED = 'failed';
	const EXTRA_POINT_RESULT_BLOCKED = 'blocked';
	const EXTRA_POINT_RESULT_SAFETY = 'safety';
	const EXTRA_POINT_RESULT_ABORTED = 'aborted';

	const TWO_POINT_CONVERSION_RESULT_SUCCESS = 'success';
	const TWO_POINT_CONVERSION_RESULT_FAILURE = 'failure';
	const TWO_POINT_CONVERSION_RESULT_SAFETY = 'safety';
	const TWO_POINT_CONVERSION_RESULT_RETURN = 'return';

	const SERIES_RESULT_FIRST_DOWN = 'First down';
	const SERIES_RESULT_TOUCHDOWN = 'Touchdown';
	const SERIES_RESULT_OPP_TOUCHDOWN = 'Opp touchdown';
	const SERIES_RESULT_FIELD_GOAL = 'Field goal';
	const SERIES_RESULT_MISSED_FIELD_GOAL = 'Missed field goal';
	const SERIES_RESULT_SAFETY = 'Safety';
	const SERIES_RESULT_TURNOVER = 'Turnover';
	const SERIES_RESULT_PUNT = 'Punt';
	const SERIES_RESULT_TURNOVER_ON_DOWNS = 'Turnover on downs';
	const SERIES_RESULT_QB_KNEEL = 'QB kneel';
	const SERIES_RESULT_END_OF_HALF = 'End of half';
}
