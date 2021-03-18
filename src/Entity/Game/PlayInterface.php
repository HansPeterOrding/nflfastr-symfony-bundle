<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game;

interface PlayInterface
{
	const COLUMN_PLAY_ID = 'play_id';
	const COLUMN_GAME_ID = 'game_internal_id';
	const COLUMN_DRIVE = 'drive';
	const COLUMN_DRIVE_ID = 'drive_internal_id';
	const COLUMN_SEASON = 'season';
	const COLUMN_SIDE_OF_FIELD = 'side_of_field';
	const COLUMN_YARDLINE_100 = 'yardline_100';
	const COLUMN_QUARTER_SECONDS_REMAINING = 'quarter_seconds_remaining';
	const COLUMN_HALF_SECONDS_REMAINING = 'half_seconds_remaining';
	const COLUMN_GAME_SECONDS_REMAINING = 'game_seconds_remaining';
	const COLUMN_GAME_HALF = 'game_half';
	const COLUMN_QUARTER_END = 'quarter_end'; //bool
	const COLUMN_SP = 'sp';
	const COLUMN_QUARTER = 'qtr';
	const COLUMN_DOWN = 'down';
	const COLUMN_GOAL_TO_GO = 'goal_to_go';
	const COLUMN_TIME = 'time';
	const COLUMN_YDSTOGO = 'ydstogo';
	const COLUMN_YDSNET = 'ydsnet';
	const COLUMN_DESC = 'desc';
	const COLUMN_PLAY_TYPE = 'play_type';
	const COLUMN_YARDS_GAINED = 'yards_gained';

	const GAME_HALF_FIRST = 'first';
	const GAME_HALF_SECOND = 'second';
	const GAME_HALF_OVERTIME = 'overtime';

	const TYPE_PASS = 'pass';
	const TYPE_RUN = 'run';
	const TYPE_FIELD_GOAL = 'field_goal';
	const TYPE_KICKOFF = 'kickoff';
	const TYPE_PUNT = 'punt';
	const TYPE_EXTRA_POINT = 'extra_point';
	const TYPE_QB_KNEEL = 'qb_kneel';
	const TYPE_QB_SPIKE = 'qb_spike';
	const TYPE_NO_PLAY = 'no_play';
	const TYPE_END_OF_PLAY = 'end_of_play';
}
