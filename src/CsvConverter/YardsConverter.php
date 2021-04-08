<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\Yards;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\YardsInterface;

class YardsConverter extends AbstractCsvConverter implements YardsConverterInterface
{
	public function defineEntityClass()
	{
		$this->entityClass = Yards::class;
	}

	public function toEntity(array $record): Yards
	{
		$yards = new Yards();

		$yards->setGained(static::toInt($record[YardsInterface::COLUMN_YARDS_GAINED]));
		$yards->setNet(static::toInt($record[YardsInterface::COLUMN_YDSNET]));
		$yards->setToGo(static::toInt($record[YardsInterface::COLUMN_YDSTOGO]));
		$yards->setAir(static::toInt($record[YardsInterface::COLUMN_AIR_YARDS]));
		$yards->setAfterCatch(static::toInt($record[YardsInterface::COLUMN_YARDS_AFTER_CATCH]));
		$yards->setPassing(static::toInt($record[YardsInterface::COLUMN_PASSING_YARDS]));
		$yards->setReceiving(static::toInt($record[YardsInterface::COLUMN_RECEIVING_YARDS]));
		$yards->setRushing(static::toInt($record[YardsInterface::COLUMN_RUSHING_YARDS]));
		$yards->setLateralReceiving(static::toInt($record[YardsInterface::COLUMN_LATERAL_RECEIVING_YARDS]));
		$yards->setLateralRushing(static::toInt($record[YardsInterface::COLUMN_LATERAL_RUSHING_YARDS]));
		$yards->setFumbleRecovery1(static::toInt($record[YardsInterface::COLUMN_FUMBLE_RECOVERY_1_YARDS]));
		$yards->setFunbleRecovery2(static::toInt($record[YardsInterface::COLUMN_FUMBLE_RECOVERY_2_YARDS]));
		$yards->setReturn(static::toInt($record[YardsInterface::COLUMN_RETURN_YARDS]));
		$yards->setPenalty(static::toInt($record[YardsInterface::COLUMN_PENALTY_YARDS]));
		$yards->setDrivePenalized(static::toInt($record[YardsInterface::COLUMN_DRIVE_YARDS_PENALIZED]));

		return $yards;
	}
}
