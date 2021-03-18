<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Drive;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\DriveInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\PlayInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\DriveRepository;

class DriveConverter extends AbstractCsvConverter implements DriveConverterInterface
{
	private GameConverterInterface $gameConverter;

	public function __construct(
		DriveRepository $repository,
		GameConverterInterface $gameConverter
	)
	{
		$this->repository = $repository;
		$this->gameConverter = $gameConverter;
	}

	public function defineEntityClass()
	{
		$this->entityClass = Drive::class;
	}

	public function toEntity(array $record, ?Game $game = null): Drive
	{
		if(!$game) {
			$game = $this->gameConverter->toEntity($record);
		}

		$record[PlayInterface::COLUMN_GAME_ID] = $game->getId();

		/** @var Drive $drive */
		$drive = $this->getOrCreateEntity($record);

		$drive->setGame($game);
		$drive->setNumber(static::toInt($record[DriveInterface::COLUMN_DRIVE]));
		$drive->setRealStartTime(static::toTime($record[DriveInterface::COLUMN_DRIVE_REAL_START_TIME]));
		$drive->setPlayCount(static::toInt($record[DriveInterface::COLUMN_DRIVE_PLAY_COUNT]));
		$drive->setTimeOfPosession(static::toTime($record[DriveInterface::COLUMN_DRIVE_TIME_OF_POSSESSION]));
		$drive->setFirstDowns(static::toInt($record[DriveInterface::COLUMN_DRIVE_FIRST_DOWNS]));
		$drive->setInsideTwenty(static::toBool($record[DriveInterface::COLUMN_DRIVE_INSIDE20]));
		$drive->setEndedWithScore(static::toBool($record[DriveInterface::COLUMN_DRIVE_ENDED_WITH_SCORE]));
		$drive->setQuarterStart(static::toInt($record[DriveInterface::COLUMN_DRIVE_QUARTER_START]));
		$drive->setQuarterEnd(static::toInt($record[DriveInterface::COLUMN_DRIVE_QUARTER_END]));
		$drive->setYardsPenalized(static::toInt($record[DriveInterface::COLUMN_DRIVE_YARDS_PENALIZED]));
		$drive->setStartTransition(static::toString($record[DriveInterface::COLUMN_DRIVE_START_TRANSITION]));
		$drive->setEndTransition(static::toString($record[DriveInterface::COLUMN_DRIVE_END_TRANSITION]));
		$drive->setGameClockStart(static::toTime($record[DriveInterface::COLUMN_DRIVE_GAME_CLOCK_START]));
		$drive->setGameClockEnd(static::toTime($record[DriveInterface::COLUMN_DRIVE_GAME_CLOCK_END]));
		$drive->setStartYardLine(static::toString($record[DriveInterface::COLUMN_DRIVE_START_YARD_LINE]));
		$drive->setEndYardLine(static::toString($record[DriveInterface::COLUMN_DRIVE_END_YARD_LINE]));

		return $drive;
	}
}
