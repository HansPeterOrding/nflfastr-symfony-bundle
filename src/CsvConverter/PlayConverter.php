<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\CsvConverter;

use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\Play;
use HansPeterOrding\NflFastrSymfonyBundle\Entity\Game\PlayInterface;
use HansPeterOrding\NflFastrSymfonyBundle\Repository\PlayRepository;

class PlayConverter extends AbstractCsvConverter implements PlayConverterInterface
{
	public static array $gameHalfMappings = [
		'Half1'    => PlayInterface::GAME_HALF_FIRST,
		'Half2'    => PlayInterface::GAME_HALF_SECOND,
		'Overtime' => PlayInterface::GAME_HALF_OVERTIME
	];

	public static array $typeMappings = [
		'pass'        => PlayInterface::TYPE_PASS,
		'run'         => PlayInterface::TYPE_RUN,
		'punt'        => PlayInterface::TYPE_PUNT,
		'field_goal'  => PlayInterface::TYPE_FIELD_GOAL,
		'kickoff'     => PlayInterface::TYPE_KICKOFF,
		'extra_point' => PlayInterface::TYPE_EXTRA_POINT,
		'qb_kneel'    => PlayInterface::TYPE_QB_KNEEL,
		'qb_spike'    => PlayInterface::TYPE_QB_SPIKE,
		'no_play'     => PlayInterface::TYPE_NO_PLAY,
		'missing'     => PlayInterface::TYPE_END_OF_PLAY,
		'NA'          => null
	];

	private GameConverterInterface $gameConverter;

	private DriveConverterInterface $driveConverter;

	private FlagsConverterInterface $flagsConverter;

	private PlayResultsConverterInterface $playResultsConverter;

	private YardsConverterInterface $yardsConverter;

	private ExpectedPointsConverterInterface $expectedPointsConverter;

	private WinProbabilitiesConverterInterface $winProbabilitiesConverter;

	private PlayerAssignmentConverterInterface $playerAssignmentConverter;

	private TeamAssignmentConverterInterface $teamAssignmentConverter;

	public function __construct(
		PlayRepository $repository,
		GameConverterInterface $gameConveter,
		DriveConverterInterface $driveConverter,
		FlagsConverterInterface $flagsConverter,
		PlayResultsConverterInterface $playResultsConverter,
		YardsConverterInterface $yardsConverter,
		ExpectedPointsConverterInterface $expectedPointsConverter,
		WinProbabilitiesConverterInterface $winProbabilitiesConverter,
		PlayerAssignmentConverterInterface $playerAssignmentConverter,
		TeamAssignmentConverterInterface $teamAssignmentConverter
	) {
		$this->repository = $repository;
		$this->gameConverter = $gameConveter;
		$this->driveConverter = $driveConverter;
		$this->flagsConverter = $flagsConverter;
		$this->playResultsConverter = $playResultsConverter;
		$this->yardsConverter = $yardsConverter;
		$this->expectedPointsConverter = $expectedPointsConverter;
		$this->winProbabilitiesConverter = $winProbabilitiesConverter;
		$this->playerAssignmentConverter = $playerAssignmentConverter;
		$this->teamAssignmentConverter = $teamAssignmentConverter;
	}

	public function defineEntityClass()
	{
		$this->entityClass = Play::class;
	}

	public function toEntity(array $record): Play
	{
		$game = $this->gameConverter->toEntity($record);
		$drive = $this->driveConverter->toEntity($record);
		$flags = $this->flagsConverter->toEntity($record);
		$playResults = $this->playResultsConverter->toEntity($record);
		$yards = $this->yardsConverter->toEntity($record);

		$record[PlayInterface::COLUMN_GAME_ID] = $game->getId();
		$record[PlayInterface::COLUMN_DRIVE_ID] = $drive->getId();

		/** @var Play $play */
		$play = $this->getOrCreateEntity($record);
		$play->setOriginalPlayData($record);

		$play->setPlayId(static::toInt($record[PlayInterface::COLUMN_PLAY_ID]));
		$play->setPossessionTeamSideOfField(static::toString($record[PlayInterface::COLUMN_SIDE_OF_FIELD]));
		$play->setYardLine100(static::toInt($record[PlayInterface::COLUMN_YARDLINE_100]));
		$play->setSecondsRemainingQuarter(static::toInt($record[PlayInterface::COLUMN_QUARTER_SECONDS_REMAINING]));
		$play->setSecondsRemainingHalf(static::toInt($record[PlayInterface::COLUMN_HALF_SECONDS_REMAINING]));
		$play->setSecondsRemainingGame(static::toInt($record[PlayInterface::COLUMN_GAME_SECONDS_REMAINING]));
		$play->setGameHalf(
			static::$gameHalfMappings[$record[PlayInterface::COLUMN_GAME_HALF]]
		);
		$play->setQuarterEnd(static::toBool($record[PlayInterface::COLUMN_QUARTER_END]));
		$play->setScorePlay(static::toBool($record[PlayInterface::COLUMN_SP]));
		$play->setQuarter(static::toInt($record[PlayInterface::COLUMN_QUARTER]));
		$play->setDown(static::toInt($record[PlayInterface::COLUMN_DOWN]));
		$play->setGoalToGo(static::toBool($record[PlayInterface::COLUMN_GOAL_TO_GO]));
		$play->setTime(static::toTime($record[PlayInterface::COLUMN_TIME]));
		$play->setDescription($record[PlayInterface::COLUMN_DESC]);

		$play->setType(
			static::$typeMappings[$record[PlayInterface::COLUMN_PLAY_TYPE]]
		);
		
		$play->setGame($game);
		$play->setDrive($drive);
		$play->setFlags($flags);
		$play->setPlayResults($playResults);
		$play->setYards($yards);

		$this->addExpectedPoints($play, $record);
		$this->addWinProbabilities($play, $record);
		$this->addPlayerAssignments($play, $record);
		$this->addTeamAssignments($play, $record);

		return $play;
	}

	private function addExpectedPoints(Play $play, array $record)
	{
		$play->resetExpectedPoints();
		foreach ($this->expectedPointsConverter->buildExpectedPointsEntities($record) as $expectedPointsEntity) {
			$play->addExpectedPoints($expectedPointsEntity);
		}
	}

	private function addWinProbabilities(Play $play, array $record)
	{
		$play->resetWinProbabilities();
		foreach ($this->winProbabilitiesConverter->buildWinProbabilityEntities($record) as $winProbabilityEntity) {
			$play->addWinProbability($winProbabilityEntity);
		}
	}

	private function addPlayerAssignments(Play $play, array $record)
	{
		$play->resetPlayerAssignments();
		foreach ($this->playerAssignmentConverter->buildPlayerAssignments($record) as $playerAssignment) {
			$play->addPlayerAssignment($playerAssignment);
		}
	}

	private function addTeamAssignments(Play $play, array $record)
	{
		$play->resetTeamAssignments();
		foreach ($this->teamAssignmentConverter->buildTeamAssignments($record) as $teamAssignment) {
			$play->addTeamAssignment($teamAssignment);
		}
	}
}
