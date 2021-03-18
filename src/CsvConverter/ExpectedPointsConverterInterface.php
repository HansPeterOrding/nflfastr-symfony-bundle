<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

interface ExpectedPointsConverterInterface extends CsvConverterInterface
{
	const COLUMN_EP = 'ep';
	const COLUMN_EPA = 'epa';
	const COLUMN_TOTAL_HOME_EPA = 'total_home_epa';
	const COLUMN_TOTAL_AWAY_EPA = 'total_away_epa';
	const COLUMN_TOTAL_HOME_RUSH_EPA = 'total_home_rush_epa';
	const COLUMN_TOTAL_AWAY_RUSH_EPA = 'total_away_rush_epa';
	const COLUMN_TOTAL_HOME_PASS_EPA = 'total_home_pass_epa';
	const COLUMN_TOTAL_AWAY_PASS_EPA = 'total_away_pass_epa';
	const COLUMN_AIR_EPA = 'air_epa';
	const COLUMN_YAC_EPA = 'yac_epa';
	const COLUMN_COMP_AIR_EPA = 'comp_air_epa';
	const COLUMN_COMP_YAC_EPA = 'comp_yac_epa';
	const COLUMN_TOTAL_HOME_COMP_AIR_EPA = 'total_home_comp_air_epa';
	const COLUMN_TOTAL_AWAY_COMP_AIR_EPA = 'total_away_comp_air_epa';
	const COLUMN_TOTAL_HOME_COMP_YAC_EPA = 'total_home_comp_yac_epa';
	const COLUMN_TOTAL_AWAY_COMP_YAC_EPA = 'total_away_comp_yac_epa';
	const COLUMN_TOTAL_HOME_RAW_AIR_EPA = 'total_home_raw_air_epa';
	const COLUMN_TOTAL_AWAY_RAW_AIR_EPA = 'total_away_raw_air_epa';
	const COLUMN_TOTAL_HOME_RAW_YAC_EPA = 'total_home_raw_yac_epa';
	const COLUMN_TOTAL_AWAY_RAW_YAC_EPA = 'total_away_raw_yac_epa';

	public function buildExpectedPointsEntities(array $record): iterable;
}
