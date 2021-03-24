<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

interface WinProbabilitiesConverterInterface extends CsvConverterInterface
{
	const COLUMN_WP = 'wp';
	const COLUMN_DEF_WP = 'def_wp';
	const COLUMN_HOME_WP = 'home_wp';
	const COLUMN_AWAY_WP = 'away_wp';
	const COLUMN_WPA = 'wpa';
	const COLUMN_VEGAS_WPA = 'vegas_wpa';
	const COLUMN_VEGAS_HOME_WPA = 'vegas_home_wpa';
	const COLUMN_HOME_WP_POST = 'home_wp_post';
	const COLUMN_AWAY_WP_POST = 'away_wp_post';
	const COLUMN_VEGAS_WP = 'vegas_wp';
	const COLUMN_VEGAS_HOME_WP = 'vegas_home_wp';
	const COLUMN_TOTAL_HOME_RUSH_WPA = 'total_home_rush_wpa';
	const COLUMN_TOTAL_AWAY_RUSH_WPA = 'total_away_rush_wpa';
	const COLUMN_TOTAL_HOME_PASS_WPA = 'total_home_pass_wpa';
	const COLUMN_TOTAL_AWAY_PASS_WPA = 'total_away_pass_wpa';
	const COLUMN_AIR_WPA = 'air_wpa';
	const COLUMN_YAC_WPA = 'yac_wpa';
	const COLUMN_COMP_AIR_WPA = 'comp_air_wpa';
	const COLUMN_COMP_YAC_WPA = 'comp_yac_wpa';
	const COLUMN_TOTAL_HOME_COMP_AIR_WPA = 'total_home_comp_air_wpa';
	const COLUMN_TOTAL_AWAY_COMP_AIR_WPA = 'total_away_comp_air_wpa';
	const COLUMN_TOTAL_HOME_COMP_YAC_WPA = 'total_home_comp_yac_wpa';
	const COLUMN_TOTAL_AWAY_COMP_YAC_WPA = 'total_away_comp_yac_wpa';
	const COLUMN_TOTAL_HOME_RAW_AIR_WPA = 'total_home_raw_air_wpa';
	const COLUMN_TOTAL_AWAY_RAW_AIR_WPA = 'total_away_raw_air_wpa';
	const COLUMN_TOTAL_HOME_RAW_YAC_WPA = 'total_home_raw_yac_wpa';
	const COLUMN_TOTAL_AWAY_RAW_YAC_WPA = 'total_away_raw_yac_wpa';

	public function buildWinProbabilityEntities(array $record): iterable;
}
