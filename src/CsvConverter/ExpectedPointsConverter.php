<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\ExpectedPoints;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\ExpectedPointsInterface;

class ExpectedPointsConverter extends AbstractCsvConverter implements ExpectedPointsConverterInterface
{
	public static array $columns = [
		ExpectedPointsConverterInterface::COLUMN_EP,
		ExpectedPointsConverterInterface::COLUMN_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_RUSH_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_RUSH_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_PASS_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_PASS_EPA,
		ExpectedPointsConverterInterface::COLUMN_AIR_EPA,
		ExpectedPointsConverterInterface::COLUMN_YAC_EPA,
		ExpectedPointsConverterInterface::COLUMN_COMP_AIR_EPA,
		ExpectedPointsConverterInterface::COLUMN_COMP_YAC_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_COMP_AIR_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_COMP_AIR_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_COMP_YAC_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_COMP_YAC_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_RAW_AIR_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_RAW_AIR_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_RAW_YAC_EPA,
		ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_RAW_YAC_EPA
	];

	public function defineEntityClass()
	{
		$this->entityClass = ExpectedPoints::class;
	}

	public function buildExpectedPointsEntities(array $record): iterable
	{
		foreach (static::$columns as $column) {
			if ($record[$column] !== CsvConverterInterface::FIELD_VALUE_NOT_AVAILABLE) {
				$expectedPoints = new ExpectedPoints();
				$expectedPoints->setPoints(static::toFloat($record[$column]));
				$expectedPoints->setType(
					$this->mapType($column)
				);
				$expectedPoints->setAdded(
					$this->mapAdded($column)
				);
				$expectedPoints->setTeamType(
					$this->mapTeamType($column)
				);
				$expectedPoints->setAirOrYac(
					$this->mapAirOrYac($column)
				);

				yield $expectedPoints;
			}
		}
	}

	private function mapType(string $column): ?string
	{
		switch ($column) {
			case ExpectedPointsConverterInterface::COLUMN_COMP_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_COMP_YAC_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_COMP_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_COMP_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_COMP_YAC_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_COMP_YAC_EPA:
				return ExpectedPointsInterface::TYPE_COMP;
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_RAW_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_RAW_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_RAW_YAC_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_RAW_YAC_EPA:
				return ExpectedPointsInterface::TYPE_RAW;
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_RUSH_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_RUSH_EPA:
				return ExpectedPointsInterface::TYPE_RUSH;
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_PASS_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_PASS_EPA:
				return ExpectedPointsInterface::TYPE_PASS;
			default:
				return null;
		}
	}

	private function mapAdded(string $column): bool
	{
		switch ($column) {
			case ExpectedPointsConverterInterface::COLUMN_EP:
				return false;
			default:
				return true;
		}
	}

	private function mapTeamType(string $column): ?string
	{
		switch ($column) {
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_RUSH_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_PASS_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_COMP_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_COMP_YAC_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_RAW_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_RAW_YAC_EPA:
				return ExpectedPointsInterface::TEAM_TYPE_HOME;
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_RUSH_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_PASS_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_COMP_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_COMP_YAC_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_RAW_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_RAW_YAC_EPA:
				return ExpectedPointsInterface::TEAM_TYPE_AWAY;
			case ExpectedPointsConverterInterface::COLUMN_EP:
			case ExpectedPointsConverterInterface::COLUMN_EPA:
			case ExpectedPointsConverterInterface::COLUMN_YAC_EPA:
				return ExpectedPointsInterface::TEAM_TYPE_POS;
			default:
				return null;
		}
	}

	private function mapAirOrYac(string $column): ?string
	{
		switch($column) {
			case ExpectedPointsConverterInterface::COLUMN_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_COMP_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_COMP_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_COMP_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_RAW_AIR_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_RAW_AIR_EPA:
				return ExpectedPointsInterface::AIR_OR_YAC_AIR;
			case ExpectedPointsConverterInterface::COLUMN_YAC_EPA:
			case ExpectedPointsConverterInterface::COLUMN_COMP_YAC_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_COMP_YAC_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_COMP_YAC_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_HOME_RAW_YAC_EPA:
			case ExpectedPointsConverterInterface::COLUMN_TOTAL_AWAY_RAW_YAC_EPA:
				return ExpectedPointsInterface::AIR_OR_YAC_YAC;
			default:
				return null;
		}
	}
}
