<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;

interface YardsInterface
{
	const COLUMN_YDSNET = 'ydsnet';
	const COLUMN_YDSTOGO = 'ydstogo';
	const COLUMN_YARDS_GAINED = 'yards_gained';
	const COLUMN_AIR_YARDS = 'air_yards';
	const COLUMN_YARDS_AFTER_CATCH = 'yards_after_catch';
	const COLUMN_PASSING_YARDS = 'passing_yards';
	const COLUMN_RECEIVING_YARDS = 'receiving_yards';
	const COLUMN_RUSHING_YARDS = 'rushing_yards';
	const COLUMN_LATERAL_RECEIVING_YARDS = 'lateral_receiving_yards';
	const COLUMN_LATERAL_RUSHING_YARDS = 'lateral_rushing_yards';
	const COLUMN_FUMBLE_RECOVERY_1_YARDS = 'fumble_recovery_1_yards';
	const COLUMN_FUMBLE_RECOVERY_2_YARDS = 'fumble_recovery_2_yards';
	const COLUMN_RETURN_YARDS = 'return_yards';
	const COLUMN_PENALTY_YARDS = 'penalty_yards';
	const COLUMN_DRIVE_YARDS_PENALIZED = 'drive_yards_penalized';
}
