<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity;

interface GameInterface
{
	const COLUMN_GAME_ID = 'game_id';
	const COLUMN_OLD_GAME_ID = 'old_game_id';
	const COLUMN_SEASON_TYPE = 'season_type';
	const COLUMN_WEEK = 'week';
	const COLUMN_GAME_DATE = 'game_date';
	const COLUMN_START_TIME = 'start_time';
	const COLUMN_TOTAL_HOME_SCORE = 'home_score';
	const COLUMN_TOTAL_AWAY_SCORE = 'away_score';
	const COLUMN_HOME_TEAM = 'home_team';
	const COLUMN_AWAY_TEAM = 'away_team';

	const SEASON_TYPE_REGULAR = 'reg';
	const SEASON_TYPE_POSTSEASON = 'post';
}
