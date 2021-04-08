<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\PlayResults;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play\PlayResultsInterface;

class PlayResultsConverter extends AbstractCsvConverter implements PlayResultsConverterInterface
{
	public function defineEntityClass()
	{
		$this->entityClass = PlayResults::class;
	}

	public function toEntity(array $record): PlayResults
	{
		$playResults = new PlayResults();

		$playResults->setExtraPointResult(static::toString($record[PlayResultsInterface::COLUMN_EXTRA_POINT_RESULT]));
		$playResults->setFieldGoalResult(static::toString($record[PlayResultsInterface::COLUMN_FIELD_GOAL_RESULT]));
		$playResults->setReplayOrChallengeResult(static::toString($record[PlayResultsInterface::COLUMN_REPLAY_OR_CHALLENGE_RESULT]));
		$playResults->setSeriesResult(static::toString($record[PlayResultsInterface::COLUMN_SERIES_RESULT]));
		$playResults->setTwoPointConversionResult(static::toString($record[PlayResultsInterface::COLUMN_TWO_POINT_CONV_RESULT]));
		$playResults->setKickDistance(static::toInt($record[PlayResultsInterface::COLUMN_KICK_DISTANCE]));

		return $playResults;
	}
}
