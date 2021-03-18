<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game;

interface DriveInterface
{
	const COLUMN_DRIVE = 'drive';
	const COLUMN_DRIVE_REAL_START_TIME = 'drive_real_start_time';
	const COLUMN_DRIVE_PLAY_COUNT = 'drive_play_count';
	const COLUMN_DRIVE_TIME_OF_POSSESSION = 'drive_time_of_possession';
	const COLUMN_DRIVE_FIRST_DOWNS = 'drive_first_downs';
	const COLUMN_DRIVE_INSIDE20 = 'drive_inside20';
	const COLUMN_DRIVE_ENDED_WITH_SCORE = 'drive_ended_with_score';
	const COLUMN_DRIVE_QUARTER_START = 'drive_quarter_start';
	const COLUMN_DRIVE_QUARTER_END = 'drive_quarter_end';
	const COLUMN_DRIVE_YARDS_PENALIZED = 'drive_yards_penalized';
	const COLUMN_DRIVE_START_TRANSITION = 'drive_start_transition';
	const COLUMN_DRIVE_END_TRANSITION = 'drive_end_transition';
	const COLUMN_DRIVE_GAME_CLOCK_START = 'drive_game_clock_start';
	const COLUMN_DRIVE_GAME_CLOCK_END = 'drive_game_clock_end';
	const COLUMN_DRIVE_START_YARD_LINE = 'drive_start_yard_line';
	const COLUMN_DRIVE_END_YARD_LINE = 'drive_end_yard_line';
}
