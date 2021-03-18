<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\WinProbability;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\WinProbabilityInterface;

class WinProbabilitiesConverter extends AbstractCsvConverter implements WinProbabilitiesConverterInterface
{
	public static array $columns = [
		WinProbabilitiesConverterInterface::COLUMN_WP,
		WinProbabilitiesConverterInterface::COLUMN_DEF_WP,
		WinProbabilitiesConverterInterface::COLUMN_HOME_WP,
		WinProbabilitiesConverterInterface::COLUMN_AWAY_WP,
		WinProbabilitiesConverterInterface::COLUMN_WPA,
		WinProbabilitiesConverterInterface::COLUMN_VEGAS_WPA,
		WinProbabilitiesConverterInterface::COLUMN_VEGAS_HOME_WPA,
		WinProbabilitiesConverterInterface::COLUMN_HOME_WP_POST,
		WinProbabilitiesConverterInterface::COLUMN_AWAY_WP_POST,
		WinProbabilitiesConverterInterface::COLUMN_VEGAS_WP,
		WinProbabilitiesConverterInterface::COLUMN_VEGAS_HOME_WP,
		WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_RUSH_WPA,
		WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_RUSH_WPA,
		WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_PASS_WPA,
		WinProbabilitiesConverterInterface::COLUMN_TOTAL_WAY_PASS_WPA,
		WinProbabilitiesConverterInterface::COLUMN_AIR_WPA,
		WinProbabilitiesConverterInterface::COLUMN_YAC_WPA,
		WinProbabilitiesConverterInterface::COLUMN_COMP_AIR_WPA,
		WinProbabilitiesConverterInterface::COLUMN_COMP_YAC_WPA,
		WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_COMP_AIR_WPA,
		WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_COMP_AIR_WPA,
		WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_COMP_YAC_WPA,
		WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_COMP_YAC_WPA,
		WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_RAW_AIR_WPA,
		WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_RAW_AIR_WPA,
		WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_RAW_YAC_WPA,
		WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_RAW_YAC_WPA
	];

	public function defineEntityClass()
	{
		$this->entityClass = WinProbability::class;
	}

	public function buildWinProbabilityEntities(array $record): iterable
	{
		foreach (static::$columns as $column) {
			if ($record[$column] !== CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
				$winProbability = new WinProbability();
				$winProbability->setPoints(static::toFloat($record[$column]));
				$winProbability->setType(
					$this->mapType($column)
				);
				$winProbability->setAdded(
					$this->mapAdded($column)
				);
				$winProbability->setTeamType(
					$this->mapTeamType($column)
				);
				$winProbability->setAirOrYac(
					$this->mapAirOrYac($column)
				);
				$winProbability->setVegas(
					$this->mapVegas($column)
				);

				yield $winProbability;
			}
		}
	}

	private function mapType(string $column): ?string
	{
		switch ($column) {
			case WinProbabilitiesConverterInterface::COLUMN_COMP_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_COMP_YAC_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_COMP_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_COMP_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_COMP_YAC_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_COMP_YAC_WPA:
				return WinProbabilityInterface::TYPE_COMP;
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_RAW_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_RAW_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_RAW_YAC_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_RAW_YAC_WPA:
				return WinProbabilityInterface::TYPE_RAW;
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_RUSH_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_RUSH_WPA:
				return WinProbabilityInterface::TYPE_RUSH;
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_PASS_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_WAY_PASS_WPA:
				return WinProbabilityInterface::TYPE_PASS;
			case WinProbabilitiesConverterInterface::COLUMN_HOME_WP_POST:
			case WinProbabilitiesConverterInterface::COLUMN_AWAY_WP_POST:
				return WinProbabilityInterface::TYPE_POST;
			default:
				return null;
		}
	}

	private function mapAdded(string $column): bool
	{
		switch ($column) {
			case WinProbabilitiesConverterInterface::COLUMN_WP:
			case WinProbabilitiesConverterInterface::COLUMN_DEF_WP:
			case WinProbabilitiesConverterInterface::COLUMN_HOME_WP:
			case WinProbabilitiesConverterInterface::COLUMN_AWAY_WP:
			case WinProbabilitiesConverterInterface::COLUMN_HOME_WP_POST:
			case WinProbabilitiesConverterInterface::COLUMN_AWAY_WP_POST:
			case WinProbabilitiesConverterInterface::COLUMN_VEGAS_WP:
			case WinProbabilitiesConverterInterface::COLUMN_VEGAS_HOME_WP:
				return false;
			default:
				return true;
		}
	}

	private function mapTeamType(string $column): ?string
	{
		switch ($column) {
			case WinProbabilitiesConverterInterface::COLUMN_HOME_WP:
			case WinProbabilitiesConverterInterface::COLUMN_VEGAS_HOME_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_HOME_WP_POST:
			case WinProbabilitiesConverterInterface::COLUMN_VEGAS_HOME_WP:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_RUSH_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_PASS_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_COMP_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_COMP_YAC_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_RAW_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_RAW_YAC_WPA:
				return WinProbabilityInterface::TEAM_TYPE_HOME;
			case WinProbabilitiesConverterInterface::COLUMN_AWAY_WP:
			case WinProbabilitiesConverterInterface::COLUMN_AWAY_WP_POST:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_RUSH_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_COMP_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_COMP_YAC_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_RAW_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_RAW_YAC_WPA:
				return WinProbabilityInterface::TEAM_TYPE_AWAY;
			case WinProbabilitiesConverterInterface::COLUMN_WP:
			case WinProbabilitiesConverterInterface::COLUMN_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_VEGAS_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_VEGAS_WP:
				return WinProbabilityInterface::TEAM_TYPE_POS;
			case WinProbabilitiesConverterInterface::COLUMN_DEF_WP:
				return WinProbabilityInterface::TEAM_TYPE_DEF;
			default:
				return null;
		}
	}

	private function mapAirOrYac(string $column): ?string
	{
		switch ($column) {
			case WinProbabilitiesConverterInterface::COLUMN_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_COMP_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_COMP_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_COMP_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_RAW_AIR_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_RAW_AIR_WPA:
				return WinProbabilityInterface::AIR_OR_YAC_AIR;
			case WinProbabilitiesConverterInterface::COLUMN_YAC_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_COMP_YAC_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_COMP_YAC_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_COMP_YAC_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_HOME_RAW_YAC_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_TOTAL_AWAY_RAW_YAC_WPA:
				return WinProbabilityInterface::AIR_OR_YAC_YAC;
			default:
				return null;
		}
	}

	private function mapVegas(string $column): bool
	{
		switch ($column) {
			case WinProbabilitiesConverterInterface::COLUMN_VEGAS_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_VEGAS_HOME_WPA:
			case WinProbabilitiesConverterInterface::COLUMN_VEGAS_WP:
			case WinProbabilitiesConverterInterface::COLUMN_VEGAS_HOME_WP:
				return true;
			default:
				return false;
		}
	}
}
